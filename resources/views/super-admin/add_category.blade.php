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
    <div class="container">
    
    <div class="row justify-content-center mx-0">
        <form class="col-lg-6 col-md-8 bg-white new-shadow-sm rounded px-2 py-3">
            <a href="{{url('/sindex')}}" class="d-flex justify-content-end text-dark">
                <i data-feather="x-circle" id="close-btn" height="18px"></i>
            </a>
            <div class="mt-2 justify-content-center align-items-center d-flex">
                <img src="{{asset('assets/images/svg-icons/super-admin/category.svg')}}" height="20px" />
                <h5 class="ml-2 text-center text-dark">Add New Category</h5>
            </div>
            
            <hr class="mt-1">
            <div class="col-12 px-3 form-group has-icon d-flex align-items-center">
                <i data-feather="edit-3" class="form-control-icon ml-2" height="19px"></i>
                <input type="text" class="form-control" placeholder="Enter Catagory Name ex. Sport, IT, Cultural.." />
            </div>
            <div class="text-center font-size-13 font-weight-bold pb-3">Select image realted to Event Category</div>
            <div class="col-12 row justify-content-between justify-content-md-start mx-0">
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox1" value="child (1).svg"/>
                    <label for="myCheckbox1">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/check.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox2" value="child.svg"  />
                    <label for="myCheckbox2">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/camera.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox3" value="girl.svg"  />
                    <label for="myCheckbox3">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/cricket.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox4" value="professor.svg"/>
                    <label for="myCheckbox4">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/drama.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox5" value="teacher.svg" />
                    <label for="myCheckbox5">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/guitar.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox6" value="woman.svg" />
                    <label for="myCheckbox6">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/india.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox7" value="woman.svg" />
                    <label for="myCheckbox7">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/website.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox8" value="woman.svg" />
                    <label for="myCheckbox8">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/unknown.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox9" value="woman.svg" />
                    <label for="myCheckbox9">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/quiz.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox10" value="woman.svg" />
                    <label for="myCheckbox10">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/pen.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox11" value="woman.svg" />
                    <label for="myCheckbox11">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/project-management.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox12" value="woman.svg" />
                    <label for="myCheckbox12">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/makeup.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox13" value="woman.svg" />
                    <label for="myCheckbox13">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/festival.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox14" value="woman.svg" />
                    <label for="myCheckbox14">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/collaboration.svg')}}" height="45px" />
                    </label>
                </div>
                <div class="cat-photo col col-auto">
                    <input type="radio" name="avatar" class="myCheckbox" id="myCheckbox15" value="woman.svg" />
                    <label for="myCheckbox15">
                    <img src="{{asset('assets/images/svg-icons/super-admin/event_cat/coffee-cup.svg')}}" height="45px" />
                    </label>
                </div>
            </div>
            <button type="submit" class="mt-3 ml-3 btn btn-success rounded-sm new-shadow-sm hover-me-sm font-weight-bold pl-2 pr-3">
            <i data-feather="plus-circle" height="18px"></i>
            <span>Add</span>
            </button>
            <button type="reset" class="mt-3 ml-2 btn btn-danger rounded-sm new-shadow-sm hover-me-sm font-weight-bold pl-2 pr-3">
            <i data-feather="rotate-ccw" height="18px"></i>
            <span>Clear</span>
            </button>
        </form>
    </div>
    </div>
@endsection

@section('extra-scripts')

@endsection