<div class="status-change">
   @php
      $checked = ($status == 'S' || $status == 1) ? 'checked' : '';
   @endphp
   <input
      type="checkbox"
      class="status"
      {{ $checked }}
      data-toggle="toggle"
      data-onstyle="outline-success"
      data-offstyle="outline-danger"
      data-on="Sim"
      data-off="Não"
      data-size="sm"
      data-table="{{$table}}"
      data-id="{{$id}}"
   />
</div>
