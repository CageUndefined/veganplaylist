<div class="card">
    <div class="card-header text-center">
              @include('inc.listbuttons')
    </div>
    <div class="card-body">
    <ul class="list-group">
      @php
          $title = Array('Cras justo odio', 'Dapibus ac facilisis in', 'Morbi leo risus', 'Porta ac consectetur ac', 'Vestibulum at eros');
      @endphp
    @for ($i = $item_count; $i < 10; $i++)
      @php
          $minute = rand(1,59);
          $second = rand(1,59);
          $time = sprintf("%d:%02d", $minute, $second);
          $t_ind = rand(0,4);
          $this_title = $title[$t_ind];
      @endphp
      <li class="list-group-item d-flex justify-content-between align-items-center">
          {{ $this_title }}
          <small>{{ $time }}</small>
      </li>
    @endfor
    </ul>
    <br>
    </div>
</div>
