<?php 
session_start();
include_once '../a_parts/urlSection.php';
include_once '../a_parts/authHeader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../../includes/css/apps/visiterManagerCss.php'; ?>
    
</head>
<body class="alt-menu sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <?php include_once '../a_parts/navbar.php'; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php include_once '../a_parts/menubar.php'; ?>
        <!--  END TOPBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row invoice layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="app-hamburger-container">
                            <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
                        </div>
                        <div class="doc-container">
                            <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="search">
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                        <ul class="nav nav-pills inv-list-container d-block" id="pills-tab" role="tablist">
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-container">
                                <div class="invoice-inbox">

                                    <div class="inv-not-selected">
                                        <p>Open a visiter from the list.</p>
                                    </div>

                                    <div class="invoice-header-section">
                                        <h4 class="inv-number"></h4>
                                        <div style="float:right;width:auto;">
                                            <div class="invoice-action" style="display:inline-block;direction:rtl;">
                                                <button class="btn btn-primary action-print">Print</button>
                                            </div>
                                            <div class="invoice-action sendFeedback" style="display:inline-block;direction:rtl;">
                                                <button class="btn action-print" style="background-color: #e95f2b;color:white;">Feedback</button>
                                            </div>
                                            <div class="invoice-action sendMails" style="display:inline-block;direction:rtl;">
                                                <button class="btn btn-warning"><div class="spinner-border text-white align-self-center loader-sm " style="width:17px;height:17px"></div> Send Mail</button>
                                            </div>
                                            <div class="invoice-action makeACall" style="display:inline-block;direction:rtl;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="ct">
                                    </div>


                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
                </div>
        <?php include_once '../a_parts/footer.php'; ?>
        </div>
        <!--  END CONTENT AREA  -->


    </div>
    <!-- END MAIN CONTAINER -->

    <?php include_once '../../includes/js/apps/visiterManagerJs.php'; ?>
    <div id="endTableScriptFiles"></div>
    <?php include_once '../../includes/js/a_parts/sweetAlertsJs.php'; ?>
</body>
</html>