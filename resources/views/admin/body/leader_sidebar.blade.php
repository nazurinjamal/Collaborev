<div class="vertical-menu">

            @php

            $id = Auth::user()->id;
            $adminData = App\Models\User::find($id);

            @endphp

                <div data-simplebar class="h-100">
                <div class="user-profile text-center mt-3">
                        <div class="">
                            <img src="{{ (!empty($adminData->profile_picture))? url('upload/admin_images/'.$adminData->profile_picture): url('upload/user.png') }}" alt="" class="avatar-md rounded-circle">
                        </div>
                        <div class="mt-3">
                            <h4 class="font-size-16 mb-1">{{$adminData->name}}</h4>
                            <span class="text-muted"><i class="ri-checkbox-blank-circle-fill align-middle font-size-10 text-success"></i> Online</span>
                        </div>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="/reviewleader/dashboard" class="waves-effect">
                                    <i class="ri-home-5-line"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="/reviewleader/document" class=" waves-effect">
                                    <i class="ri-file-line"></i>
                                    <span>Document</span>
                                </a>
                            </li>

                            <li>
                                <a href="/reviewleader/report" class=" waves-effect">
                                    <i class="ri-edit-box-line"></i>
                                    <span>Report</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('admin.profile')}}" class=" waves-effect">
                                    <i class="ri-user-line"></i>
                                    <span>Profile</span>
                                </a>
                            </li>

                        </ul>

                        <style>
                            .bottom-text {
                                position: absolute;
                                bottom: 0;
                                color: black;
                                margin: 20px;
                                font-size: 10px;;
                            }
                        </style>
                        <div class="bottom-text">
                            <strong>Collaborev.</strong>
                            <br>
                            ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> All Rights Reserved.
                        </div>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
</div>