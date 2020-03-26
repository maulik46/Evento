@extends('super-admin/s_admin_layout')

@section('title','Add Event Category')

@section('head-tag-links')
<style>
    .form-control:focus {
        border-color: #f3efef !important;
    }
    .cat-photo input[type="radio"][class="myCheckbox"] {
        display: none;
        }

        .cat-photo label {
        border: 2px solid #f3efef;
        display: flex;
        position: relative;
        cursor: pointer;
        padding:5px;
        border-radius:8px;
        }

        .cat-photo label img {
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
        }

        :checked + label {
        border-color: var(--info);
        background-color: rgba(37,194,227,.15);
        /* border-radius:8px; */
        }

        :checked + label:before {
        content: "";
        transform: scale(1);
        }

        :checked + label img {
        transform: scale(0.95);
        }
        
    
    @media(max-width:568px){
        .cat-photo img{
            height:45px;
        }
    }
</style>
@endsection

@section('my-content')
@if(Session::has('error'))
<div class="toast bg-danger fade show border-0 new-shadow rounded position-fixed w-75"
        style="top:80px;right:30px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true"
        data-toggle="toast">
        <div class="toast-body text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle" id="close-btn" height="18px"></i>
            </a>
            <div class="mt-2 font-weight-bold font-size-14">
                {{Session::get('error')}}
            </div>

        </div>
    </div>
@endif
    <div class="container">
    
    <div class="row justify-content-center mx-0">
        <form action="{{url('updatecat')}}" method="post" class="col-lg-6 col-md-8 bg-white new-shadow-sm rounded px-2 py-3">
        @csrf
            <a href="{{url('/sindex')}}" class="d-flex justify-content-end text-dark">
                <i data-feather="x-circle" id="close-btn" height="18px"></i>
            </a>
            <div class="mt-2 justify-content-center align-items-center d-flex">
                <img src="{{asset('assets/images/svg-icons/super-admin/category.svg')}}" height="20px" />
                <h5 class="ml-2 text-center text-dark">Update Category</h5>
            </div>
            
            <hr class="mt-1">
            <div class="col-12 px-3 form-group has-icon d-flex align-items-center">
                <i data-feather="edit-3" class="form-control-icon ml-2" height="19px"></i>
                <input type="text" name="catname" class="form-control" placeholder="Enter Catagory Name ex. Sport, IT, Cultural.." value="{{$cat->category_name}}"/>
            </div>
            <div class="text-center font-size-13 font-weight-bold pb-3">Select image realted to Event Category</div>
            <div class="col-12 row justify-content-between justify-content-md-start mx-0">
                <div class="cat-photo col col-auto">
                    <input type="hidden" name="cid" value="{{$cat->category_id}}">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox1" value="check.svg" @if($cat->cat_pic == "check.svg") checked @endif/>
                    <label for="myCheckbox1">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/check.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox2" value="camera.svg" @if($cat->cat_pic == "camera.svg") checked @endif  />
                    <label for="myCheckbox2">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/camera.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox3" value="cricket.svg" @if($cat->cat_pic == "cricket.svg") checked @endif />
                    <label for="myCheckbox3">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/cricket.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox4" value="drama.svg" @if($cat->cat_pic == "drama.svg") checked @endif  />
                    <label for="myCheckbox4">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/drama.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox5" value="guitar.svg" @if($cat->cat_pic == "guitar.svg") checked @endif  />
                    <label for="myCheckbox5">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/guitar.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox6" value="india.svg" @if($cat->cat_pic == "india.svg") checked @endif />
                    <label for="myCheckbox6">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/india.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox7" value="website.svg" @if($cat->cat_pic == "website.svg") checked @endif />
                    <label for="myCheckbox7">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/website.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox8" value="unknown.svg" @if($cat->cat_pic == "unknown.svg") checked @endif  />
                    <label for="myCheckbox8">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/unknown.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox9" value="quiz.svg" @if($cat->cat_pic == "quiz.svg") checked @endif />
                    <label for="myCheckbox9">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/quiz.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox10" value="pen.svg" @if($cat->cat_pic == "pen.svg") checked @endif  />
                    <label for="myCheckbox10">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/pen.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox11" value="project-management.svg" @if($cat->cat_pic == "project-management.svg") checked @endif />
                    <label for="myCheckbox11">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/project-management.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox12" value="makeup.svg" @if($cat->cat_pic == "makeup.svg") checked @endif />
                    <label for="myCheckbox12">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/makeup.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox13" value="festival.svg" @if($cat->cat_pic == "festival.svg") checked @endif  />
                    <label for="myCheckbox13">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/festival.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox14" value="collaboration.svg" @if($cat->cat_pic == "collaboration.svg") checked @endif />
                    <label for="myCheckbox14">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/collaboration.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox15" value="coffee-cup.svg" @if($cat->cat_pic == "coffee-cup.svg") checked @endif />
                    <label for="myCheckbox15">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/coffee-cup.svg')}}" height="45px" />
                    </label>
                </div>
            </div>
            <button type="submit" class="mt-3 ml-3 btn btn-success rounded-sm new-shadow-sm hover-me-sm font-weight-bold pl-2 pr-3">
            <i data-feather="edit" height="18px"></i>
            <span>Update</span>
            </button>
            
        </form>
    </div>
    </div>
@endsection

@section('extra-scripts')

@endsection
