# https://github.com/mps-youtube/pafy
# https://github.com/r0oth3x49/vimeo
import pafy, datetime, json, io, vimeo_dl

with open( 'import/VeganPlaylist.csv' ) as fh:
    data = fh.readlines()

# Organise data into labels and rows
data = [ line.strip().split( ',' ) for line in data ]
labels = [ label.strip() for label in data[ 3 ] ]
data = data[ 4: ]

# Match column values to labels
videos = []
for row in data:
    video = {}
    tags = []
    for label, value, i in zip( labels, row, range( len( labels ) ) ):
        value = value.strip()
        if label and value:
            if i > 4:
                tags.append( label )
            else:
                video[ label ] = value
    if video:
        video[ 'tags' ] = tags
        videos.append( video )

strMigrate = """<?php

use Illuminate\Database\Migrations\Migration;
use App\Video;

class ImportVideos extends Migration
{
public function up()
{
$tags = App\Tag::all();
$tag = function( $name ) use ( $tags ) { return $tags->where( 'name', $name )->first()->id; };
%s
}
}"""

print 'Processing %d videos...' % len( videos )

# Create migration data string
strData = u''
IDs = []
for entry in videos:
    if 'vimeo' in entry[ 'URL' ]:
        video = vimeo_dl.new( entry[ 'URL' ] )
        if video.video_id in IDs:
            continue
        IDs.append( video.video_id )

        res = video.getbest().resolution.split( 'x' )
        videoData = {
            'service': 'v',
            'service_video_id': video.video_id,
            'title': video.title,
            'length': video._info[ 'duration' ],
            'widescreen': float( res[ 0 ] ) / float( res[ 1 ] ) > 1.5,
            'mature': 'Mature' in entry,
            'graphic': 'Graphic' in entry
        }
    else:
        video = pafy.new( entry[ 'URL' ] )
        if video.videoid in IDs:
            continue
        IDs.append( video.videoid )

        res = video.getbest().resolution.split( 'x' )
        videoData = {
            'service': 'y',
            'service_video_id': video.videoid,
            'title': video.title,
            'length': video.length,
            'widescreen': float( res[ 0 ] ) / float( res[ 1 ] ) > 1.5,
            'mature': 'Mature' in entry,
            'graphic': 'Graphic' in entry
        }
    
    strData += '$video = App\Video::create( json_decode( \'%s\', true ) );\n' % json.dumps( videoData ).replace( "'", "\\'" )
    for tag in entry[ 'tags' ]:
        strData += '$video->tags()->attach( $tag( "%s" ) );\n' % tag
    strData += '$video->save();\n'

print 'Processing succesful, %d duplicates found' % ( len( videos ) - len( IDs ) ) 

name = datetime.datetime.utcnow().strftime( "migrations/%Y_%m_%d_%H%M%S_import_videos.php")
with io.open( name, 'w', encoding='utf-8') as fh:
    fh.write( strMigrate % strData )
print 'Created migration', name
