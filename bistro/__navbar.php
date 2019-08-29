<div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0 bg-color">
          <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-black flex-md-nowrap border-bottom p-0">
              <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <!-- logo -->
                <div class="d-table m-auto">
                  <img id="main-logo" class="d-inline-block align-middle mr-1" style="max-width: 140px;" src="images/logo1.png" alt="Shards Dashboard">
                  <span class="d-none d-md-inline ml-1"></span>
                </div>
              </a>
              <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
              </a>
            </nav>
          </div>
          <!-- search-sm -->
          <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
            <div class="input-group input-group-seamless ml-3">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-search"></i>
                </div>
              </div>
              <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
          </form>
          <!-- slidebar -->
          <div class="nav-wrapper">
            <ul class="nav flex-column">

              <!-- 會員 -->
              <li class="nav-item has-sub">
                <span class="nav-link dropdown-heading">
                  <i class="material-icons">person</i>會員管理<i class="material-icons pl-2">expand_more</i>
                </span>
                <ul>
                <li><a class="nav-link <?= $page_name=='member' ? 'active' : '' ?>" href="member.php">會員列表</a></li>
                  <li><a class="nav-link <?= $page_name=='member' ? 'active' : '' ?>" href="member.php">新增會員</a></li>
                </ul>
              </li>
            
              <!-- 酒吧 -->
              <li class="nav-item has-sub">
                <span class="nav-link dropdown-heading">
                  <i class="material-icons">vertical_split</i>酒吧管理<i class="material-icons pl-2">expand_more</i>
                </span>
                <ul>
                  <li><a class="nav-link <?= $page_name=='bar' ? 'active' : '' ?>" href="bar.php">酒吧列表</a></li>
                  <li><a class="nav-link <?= $page_name=='bar' ? 'active' : '' ?>" href="bar.php">新增酒吧</a></li>
                </ul>
              </li>

              <!-- 酒商 -->
              <li class="nav-item has-sub">
                <span class="nav-link dropdown-heading">
                  <i class="material-icons">recent_actors</i>酒商管理<i class="material-icons pl-2">expand_more</i>
                </span>
                <ul>
                  <li><a class="nav-link <?= $page_name=='business' ? 'active' : '' ?>" href="business.php">酒商列表</a></li>
                  <li><a class="nav-link <?= $page_name=='data_insert' ? 'active' : '' ?>" href="data_insert.php">新增酒商</a></li>
                </ul>
              </li>

              <!-- 酒 -->
              <li class="nav-item has-sub">
                <span class="nav-link dropdown-heading">
                  <i class="material-icons">local_bar</i>酒類管理<i class="material-icons pl-2">expand_more</i>
                </span>
                <ul>
                  <li><a class="nav-link <?= $page_name=='data_list' ? 'active' : '' ?>" href="data_list.php">酒類列表</a></li>
                  <li><a class="nav-link <?= $page_name=='data_insert' ? 'active' : '' ?>" href="data_insert.php">新增酒類</a></li>
                </ul>
              </li>

              <!-- 活動 -->
              <li class="nav-item has-sub">
                <span class="nav-link dropdown-heading">
                  <i class="material-icons">wb_sunny</i>活動管理<i class="material-icons pl-2">expand_more</i>
                </span>
                <ul>
                  <li><a class="nav-link <?= $page_name=='activity' ? 'active' : '' ?>" href="activity.php">活動列表</a></li>
                  <li><a class="nav-link <?= $page_name=='activity' ? 'active' : '' ?>" href="activity.php">新增活動</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </aside>
        
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <!-- Main Navbar -->
          <div class="main-navbar sticky-top bg-color">
            <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
              <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <!-- search -->
                <div class="input-group input-group-seamless ml-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                  <input class="navbar-search form-control bg-color" type="text" placeholder="Search..." aria-label="Search"></div>
              </form>
              <!-- 會員登入資訊 -->
              <ul class="navbar-nav border-left flex-row d-flex align-items-center">
                <?php if(isset($_SESSION['loginUser'])): ?>
                <div class="h-60">
                  <li class="nav-item border-line-r mr-3">
                    <a class="nav-link text-nowrap px-3">
                      <img class="user-avatar rounded-circle mr-2" src="images/avatars/user.png" alt="User Avatar">
                      <span class="d-none d-md-inline-block text-secondary" style="font-size:15px;font-weight:400;cursor: default;"><?= $_SESSION['loginUser']['nickname'] ?></span>
                    </a>
                  </li>
                </div>
                <div class="h-60 pt-3">
                  <li class="nav-item mr-4">
                    <a class="text-secondary" style="text-decoration: none;font-size:16px;" href="logout.php">
                      <i class="large material-icons" style="font-size: 20px">power_settings_new</i> <!--登出-->
                    </a>
                  </li>
                  <?php else: ?>         
                  <li class="nav-item">
                    <a class="text-secondary p-4" style="text-decoration: none;font-size:16px;" href="login.php">
                      <i class="large material-icons" style="font-size: 20px">exit_to_app</i> <!--登入-->
                    </a>
                  </li>
                  <?php endif; ?>
                </div>
              </ul>
              <!-- menu-sm -->
              <nav class="nav">
                <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                  <i class="material-icons">&#xE5D2;</i>
                </a>
              </nav>
            </nav>
          </div>