<?php 
session_start();
$visiterID = isset($_GET['vid'])?$_GET['vid']:'';
if($visiterID == ""){
    
}
include_once '../a_parts/urlSection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../../includes/css/formEdit/mainFormCss.php'; ?>
    <style>
        form div{
            display: inline-block;
        }
    </style>
</head>
<body class="sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <?php include_once 'a_parts/navbar.php'; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <!-- CONTENT AREA -->
                <div class="row layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Visitor Details</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form>
                                    <div class="form-group mb-4 col-sm-4">
                                        <label for="exampleFormControlInput2">Visitor Name *</label>
                                        <input type="text" class="form-control" id="vname" placeholder="Xyz Abc">
                                    </div>
                                    <div class="form-group mb-4 col-sm-5">
                                        <label for="exampleFormControlInput2">Visitor Email *</label>
                                        <div class="input-group mb-4">
                                      <input type="email" id="vemail" placeholder="xyz@example.com" class="form-control" aria-label="Text input with segmented dropdown button">
                                      <div class="input-group-append">
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="javascript:void(0);" id='searchNfill'>Search and Auto Fill</a>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="form-group mb-4 col-sm-2">
                                        <label for="exampleFormControlInput2">Visitor Mobile *</label>
                                        <input type="email" class="form-control" id="vmobile" placeholder="+91 xxxxxxxxxx">
                                    </div>
                                    <div class="form-group mb-4 col-sm-4">
                                        <label for="exampleFormControlTextarea1">Visitor Address *</label>
                                        <textarea class="form-control" id="vaddress" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <form>
                                    <div class="form-group mb-4 col-sm-12">
                                        <label for="exampleFormControlInput2">Whom to meet *</label>
                                        <select class="form-control  basic" id="vmeet">
                                            <option selected="selected">orange</option>
                                            <option>white</option>
                                            <option>purple</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4 col-sm-12">
                                        <label for="exampleFormControlTextarea1">Porpose to visit *</label>
                                        <textarea class="form-control" id="vreason" rows="3"></textarea>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <form>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" style="position: relative;" id="switchBoard">
                                        <label class="switch s-outline s-outline-primary  mb-4 mr-2">
                                            <input type="checkbox" id="checkCamera">
                                            <span class="slider round"></span> 
                                        </label><span style="position:absolute;top:0px;">Click Pictures / Upload Picture</span>
                                    </div>
                                    <div class="form-group mb-12 col-sm-12" id="camDIV" style="display: none;">
                                        <label for="exampleFormControlTextarea1">Click Picture *</label>
                                        <br>
                                        <div class="col-sm-12">
                                            <button id="start-camera" type="button" class="btn btn-primary mb-4 mr-2 btn-sm">Camera</button>
                                            <button id="click-photo" type="button" class="btn btn-success mb-4 mr-2 btn-sm" style="display: none;">Capture Picture</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <video id="video" autoplay style="display: none;width:100%;height:auto;"></video>
                                            <canvas id="canvas" style="display: none;width:100%;height:auto;"></canvas>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group mb-12 col-sm-12" id="imgDIV" style="display: none;">
                                        
                                    </div>
                                    <div class="form-group mb-12 col-sm-12" id="uploadDIV">
                                        <div class="custom-file-container" data-upload-id="myFirstImage">
                                            <label>Upload Picture * <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" id="vimage" name="vimage" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <form>
                                    <div class="form-group mb-4 col-sm-12">
                                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-outline-primary">
                                            <input type="checkbox" class="new-control-input" id="vwhatsapp">
                                            <span class="new-control-indicator"></span>Mobile Number Has WhatsApp
                                        </label><br>
                                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-outline-primary">
                                            <input type="checkbox" class="new-control-input" id="vterms">
                                            <span class="new-control-indicator"></span>Accept Terms And Conditions
                                        </label>
                                        <br><br>
                                        <button type="button" class="btn btn-primary mb-4 mr-2 btn-lg" id="request">Request Visit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- CONTENT AREA -->

            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <?php include_once '../../includes/js/formEdit/mainFormJs.php'; ?>
</body>
</html>