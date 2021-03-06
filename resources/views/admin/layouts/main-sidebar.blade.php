<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span
                                    class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}}
                    </li>

                    <!-- ADMIN-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#admin-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                                    class="right-nav-text">المديرين</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="admin-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('admin.index') }}">كل المديرين </a> </li>
                            <li> <a href="{{ route('admin.softDelete') }}"> المديرين الغير مفعلين </a> </li>

                        </ul>
                    </li>

                    <!-- CATEGORIES-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#categories-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                                    class="right-nav-text">اقسام منتجاتنا</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="categories-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('Categories.index') }}">اضافه قسم </a> </li>
                            <li> <a href="{{ route('Categories.softDelete') }}"> الاقسام الغير مفعلة </a> </li>

                        </ul>
                    </li>

                    <!-- PRODUCTS-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#products-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span class="right-nav-text">
                                    منتجاتنا</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="products-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('products.index') }}"> المنتجات </a> </li>
                            <li> <a href="{{ route('products.softDelete') }}">المنتجات الغير مفعلة  </a> </li>
                            <li> <a href="{{ route('proImg.softDelete') }}"> الصور الغير مفعلة للمنتجات  </a> </li>


                        </ul>
                    </li>

                    <!-- ABOUT US-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#aboutUsHome-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span class="right-nav-text"> عن الشركة
                                    الصفحة الرئيسية</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="aboutUsHome-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{route('aboutUsHome.index')}}">
                                    كل البيانات
                                </a>
                                <a href="{{route('aboutUsHome.softDelete')}}">
                                    البيانات الغير مفعلة
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!-- ABOUT US-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#aboutUs-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span class="right-nav-text"> عن الشركة
                                </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="aboutUs-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{route('aboutUs.index')}}">
                                    كل البيانات
                                </a>
                                <a href="{{route('aboutUs.softDelete')}}">
                                    البيانات الغير مفعلة
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!-- CONTACT US-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#contactUs-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span class="right-nav-text"> بيانات
                                    التواصل مع الشركة </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="contactUs-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{route('contactUs.index')}}">
                                    كل البيانات
                                </a>
                                <a href="{{route('contactUs.softDelete')}}">
                                    البيانات الغير مفعلة
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#products-menu55">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span class="right-nav-text">
                                    اضافه سلايدر المنتجات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="products-menu55" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('pro_slider') }}"> ضافه سلايدر </a> </li>

                        </ul>
                    </li>


                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
