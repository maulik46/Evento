@extends('stud_layout')
    @section('title','Notice')
            @section('my-content')
                <div class="container-fluid my-5">
                   <!-- <div class="d-flex align-items-center justify-content-center" style="height: 60vh!important;">
                        <h5>
                           <i data-feather="meh" class="icon-dual"></i>
                           <span>oops..!there is no Notice available</span>
                        </h5>
                   </div> -->
                   <div>
                       <div class="card new-shadow-sm my-2 rounded-0 hover-me-sm" style="border-left: 4px solid #ff5c75;">
                           <div class="card-body py-2">
                               <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <span class="badge badge-soft-primary px-3 py-1 badge-pill">28/12/2019</span>
                                    <h6>Dr.Rohit Radadiya</h6>
                               </div>
                               <div>
                                    <h5 class="mt-0">Picnic Notice</h5>
                                    <div class="card-text mb-1"> 
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Non tenetur possimus
                                        adipisci?
                                    </div> 
                               </div>
                           </div>
                       </div>
                       <div class="card new-shadow-sm my-2 rounded-0 hover-me-sm" style="border-left: 4px solid #1ae1ac;">
                           <div class="card-body py-2">
                               <div class="d-flex justify-content-between align-items-center flex-wrap">
                                   <span class="badge badge-soft-primary px-3 py-1 badge-pill">28/12/2019</span>
                                   <h6>Dr.Rohit Radadiya</h6>
                               </div>
                               <div>
                                    <h5 class="mt-0">Picnic Notice</h5>
                                    <div class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Non tenetur possimus
                                        adipisci?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis explicabo itaque fugit pariatur adipisci. Quod, pariatur corrupti, laborum eius quaerat eos vero, necessitatibus inventore nihil provident ut consequuntur soluta magnam.
                                    </div>
                                    <div class="card-action my-2">
                                        <a href="#" class="btn btn-soft-danger rounded-sm new-shadow-sm font-weight-bold px-3 mr-1">XYZ.txt</a>

                                        <a href="#" class="btn btn-soft-success rounded-sm new-shadow-sm font-weight-bold px-3 mr-1">XYZ.pdf</a>
                                    </div>
                               </div>
                               
                           </div>
                       </div>
                   </div>
                </div>
            @endsection

