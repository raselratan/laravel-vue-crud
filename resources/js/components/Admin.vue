<template>
    <div class="admin">
    <div class="page-wrapper default-theme sidebar-bg bg1 toggled">
        <a id="show-sidebar" @click="closeMenu" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <!-- sidebar-brand  -->
                <div class="sidebar-item sidebar-brand">
                    <router-link to="/admin">Add Products
                    </router-link>
                    <div id="close-sidebar" @click="closeMenu">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-item sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="https://klipp.tv/wp-content/uploads/2017/07/AtienzaJoshua-2x2.jpg" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name">Jhon
                            <strong>Smith</strong>
                        </span>
                        <span class="user-role">Administrator</span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-item sidebar-search">
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control search-menu" placeholder="Search...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sidebar-menu  -->
                <div class=" sidebar-item sidebar-menu">
                    <ul>

                        <li class="sidebar-dropdown">
                            <a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" >
                                <i class="fab fa-product-hunt"></i>
                                Products
                            </a>
                            
                            <ul class="collapse" style="margin-left:10px" id="settingsSubmenu">
                               <li>
                                    <router-link to="/admin/add-products">
                                        <i class="fas fa-plus"></i>
                                        Add Products
                                    </router-link>
                               </li>
                               <li>
                                    <router-link to="/admin/list-products">
                                        <i class="fas fa-list"></i>
                                        Products List
                                    </router-link>
                               </li>
                            </ul>
                        </li>

                        

                        <li class="sidebar-dropdown">
                            <a href="#departmentSubmenu" data-toggle="collapse" aria-expanded="false" >
                                <i class="fas fa-building"></i>
                                Department
                            </a>
                            
                            <ul class="collapse" style="margin-left:10px" id="departmentSubmenu">

                                <li>
                                    <a href="#">
                                        <i class="fas fa-list"></i>
                                        Department List
                                    </a>
                               </li>
                            </ul>
                        </li>

                        <li class="sidebar-dropdown">
                            <a href="#employeeSubmenu" data-toggle="collapse" aria-expanded="false" >
                                <i class="fas fa-user"></i>
                                Employee
                            </a>
                            
                            <ul class="collapse" style="margin-left:10px" id="employeeSubmenu">
                               <li>
                                    <a href="#">
                                        <i class="fas fa-user-plus"></i>Add Employee
                                    </a>
                               </li>

                                <li>
                                    <a href="#">
                                        <i class="fas fa-list"></i>
                                        Employee List
                                    </a>
                               </li>
                            </ul>
                        </li>

                       
                       
                        <li>
                            <a href="/admin/logout">
                                <i class="fa fa-power-off" style="color:red"></i>
                                <span>LogOut</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>

        </nav>
        
        <!-- sidebar-content  -->
        <div class="page-content">
            <router-view :key="$route.fullPath"></router-view>
        </div>
        <!-- page-content" -->
    </div>
  </div>
</template>

<script>
export default {
  methods:{
      closeMenu(){
        $(".page-wrapper").toggleClass("toggled");
      }
  }
};
</script>





