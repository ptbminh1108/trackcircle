<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{ url('/') }}">
      <span class="align-middle">Track Circle</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-header">
        Section
      </li>

      @foreach ($menu as $menu)
      <!-- memu lv 1 -->
      <li class="sidebar-item" data-bs-toggle="collapse" href="#{{$menu['id']}}" aria-expanded="false" aria-controls="{{$menu['id']}}">
        <a class="sidebar-link" href="{{ $menu['href'] }}">
          <i class="fa {{$menu['icon']}}"></i> <span class="align-middle">{{$menu['name']}}</span>
        </a>
        <div class="collapse" id="{{$menu['id']}}">

          @foreach ($menu['children'] as $menu_lv_1)
          <ul class="sidebar-nav ">
            <li class="sidebar-item" data-bs-toggle="collapse" href="#{{$menu_lv_1['id']}}" aria-expanded="false" aria-controls="{{$menu_lv_1['id']}}">
              <a class="sidebar-link" href="{{$menu_lv_1['href']}}">
                <i class="fa {{$menu_lv_1['icon']}}"></i> <span class="align-middle">{{$menu_lv_1['name']}}</span>
              </a>
            </li>
          </ul>
          @endforeach

          <div>
            <!-- Menu lv 2 -->
      </li>
      @endforeach

    </ul>


  </div>
</nav>

<style>
  .collapse.show {
    visibility: visible;
  }

  ul ul {
    padding-left: 15px !important;
  }
</style>