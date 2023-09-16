  <nav class="main-sidebar ps-menu">
      <div class="sidebar-toggle action-toggle">
          <a href="#">
              <i class="fas fa-bars"></i>
          </a>
      </div>
      <div class="sidebar-opener action-toggle">
          <a href="#">
              <i class="ti-angle-right"></i>
          </a>
      </div>
      <div class="sidebar-header">
          <div class="sidebar-title">
              <span class="image">
                  <a href="/">
                      <img src="{{ asset('favicon.ico') }}" alt="logo">
                  </a>
              </span>

              <div class="sidebar-title-text text">
                  <span class="title-apps">pesan instan</span>
                  <span class="descriptions-apps">pengawasan inspektorat</span>
                  <span class="descriptions-apps">magetan</span>
              </div>
          </div>
          <div class="close-sidebar action-toggle">
              <i class="ti-close"></i>
          </div>
      </div>
      <div class="sidebar-content">
          <ul>
              <li class="{{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                  <a href="{{ url('dashboard') }}" class="link">
                      <i class="ti-home"></i>
                      <span>Dashboard</span>
                  </a>
              </li>
              {{-- <li class="menu-category">
                  <span class="text-uppercase">User Interface</span>
              </li> --}}

              {{-- @can('read konfigurasi')
                  <li class="{{ request()->segment(1) == 'konfigurasi' ? 'active open' : '' }}">
                      <a href="#" class="main-menu has-dropdown">
                          <i class="ti-book"></i>
                          <span>Konfigurasi</span>
                      </a>
                      <ul class="sub-menu {{ request()->segment(1) == 'konfigurasi' ? 'expand' : '' }}">
                          @can('read permission')
                              <li
                                  class="{{ request()->segment(1) == 'konfigurasi' && request()->segment(2) == 'roles' ? 'active' : '' }}">
                                  <a href="{{ url('konfigurasi/roles') }}" class="link">
                                      <span>Roles</span>
                                  </a>
                              </li>
                          @endcan
                      </ul>
                  </li>
              @endcan --}}

              {{-- menu dari db --}}
              @foreach (getMenus() as $main_menu)
                  <li class="{{ request()->segment(1) == $main_menu->url ? 'active open' : '' }}">
                      @can('read_' . $main_menu->url)
                          <a href="#" class="main-menu has-dropdown">
                              <i class="{{ $main_menu->icon }}"></i>
                              <span>{{ $main_menu->display_name }}</span>
                          </a>
                          <ul class="sub-menu {{ request()->segment(1) == $main_menu->url ? 'expand' : '' }}">
                              @foreach ($main_menu->subMenus as $sub_menu)
                                  @can('read_' . $sub_menu->url)
                                      <li class="{{ Request::path() == $sub_menu->url ? 'active' : '' }}">
                                          <a href="{{ url($sub_menu->url) }}" class="link">
                                              <span>{{ $sub_menu->display_name }}</span>
                                          </a>
                                      </li>
                                  @endcan
                              @endforeach
                          </ul>
                      @endcan
                  </li>
              @endforeach
          </ul>
      </div>
  </nav>
