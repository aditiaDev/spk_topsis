<!-- BEGIN: Top Menu -->
<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo base_url("home")?>" class="top-menu <?= ($this->uri->segment(1) == 'home') ? 'top-menu--active' : '' ?>">
                <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                <div class="top-menu__title"> Home  </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="top-menu <?= ($this->uri->segment(1) == 'master') ? 'top-menu--active' : '' ?>">
                <div class="top-menu__icon"> <i data-feather="box"></i> </div>
                <div class="top-menu__title"> Master Data  <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="<?php echo base_url("master/user")?>" class="top-menu">
                        <div class="top-menu__icon"> <i data-feather="users"></i> </div>
                        <div class="top-menu__title"> Data User </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("master/unit")?>" class="top-menu">
                        <div class="top-menu__icon"> <i data-feather="package"></i> </div>
                        <div class="top-menu__title"> Data Unit </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("master/kriteria")?>" class="top-menu">
                        <div class="top-menu__icon"> <i data-feather="layers"></i> </div>
                        <div class="top-menu__title"> Data Kriteria </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("master/karyawan")?>" class="top-menu">
                        <div class="top-menu__icon"> <i data-feather="user"></i> </div>
                        <div class="top-menu__title"> Data Karyawan Kontrak </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- END: Top Menu -->