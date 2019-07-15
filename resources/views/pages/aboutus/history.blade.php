<style>
    .timeline {
        list-style: none;
        padding: 20px 0 20px;
        position: relative;
        width: 100%;
    }

    .timeline:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 3px;
        background-color: #eeeeee;
        left: 50%;
        margin-left: -1.5px;
    }

    .timeline > li {
        margin-bottom: 20px;
        position: relative;
    }

    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }

    .timeline > li:after {
        clear: both;
    }

    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }

    .timeline > li:after {
        clear: both;
    }

    .timeline > li > .timeline-panel {
        width: 46%;
        float: left;
        border: 1px solid #d4d4d4;
        border-radius: 2px;
        padding: 20px;
        position: relative;
        -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }

    .timeline > li > .timeline-panel:before {
        position: absolute;
        top: 26px;
        right: -15px;
        display: inline-block;
        border-top: 15px solid transparent;
        border-left: 15px solid #ccc;
        border-right: 0 solid #ccc;
        border-bottom: 15px solid transparent;
        content: " ";
    }

    .timeline > li > .timeline-panel:after {
        position: absolute;
        top: 27px;
        right: -14px;
        display: inline-block;
        border-top: 14px solid transparent;
        border-left: 14px solid #fff;
        border-right: 0 solid #fff;
        border-bottom: 14px solid transparent;
        content: " ";
    }

    .timeline > li > .timeline-badge {
        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
        font-size: 1em;
        text-align: center;
        position: absolute;
        top: 16px;
        left: 50%;
        margin-left: -25px;
        background-color: #999999;
        z-index: 100;
        border-top-right-radius: 50%;
        border-top-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
    }

    .timeline > li.timeline-inverted > .timeline-panel {
        float: right;
    }

    .timeline > li.timeline-inverted > .timeline-panel:before {
        border-left-width: 0;
        border-right-width: 15px;
        left: -15px;
        right: auto;
    }

    .timeline > li.timeline-inverted > .timeline-panel:after {
        border-left-width: 0;
        border-right-width: 14px;
        left: -14px;
        right: auto;
    }

    .timeline-badge.primary {
        background-color: #2e6da4 !important;
    }

    .timeline-badge.success {
        background-color: #3f903f !important;
    }

    .timeline-badge.warning {
        background-color: #f0ad4e !important;
    }

    .timeline-badge.danger {
        background-color: #d9534f !important;
    }

    .timeline-badge.info {
        background-color: #5bc0de !important;
    }

    .timeline-title {
        margin-top: 0;
        color: inherit;
        font-size: 1.25rem;
    }

    .timeline-body > p,
    .timeline-body > ul {
        margin-bottom: 0;
    }

    .timeline-body > p + p {
        margin-top: 5px;
    }

    @media (max-width: 767px) {
        ul.timeline:before {
            left: 40px;
        }

        ul.timeline > li > .timeline-panel {
            width: calc(100% - 90px);
            width: -moz-calc(100% - 90px);
            width: -webkit-calc(100% - 90px);
        }

        ul.timeline > li > .timeline-badge {
            left: 15px;
            margin-left: 0;
            top: 16px;
        }

        ul.timeline > li > .timeline-panel {
            float: right;
        }

        ul.timeline > li > .timeline-panel:before {
            border-left-width: 0;
            border-right-width: 15px;
            left: -15px;
            right: auto;
        }

        ul.timeline > li > .timeline-panel:after {
            border-left-width: 0;
            border-right-width: 14px;
            left: -14px;
            right: auto;
        }
    }
</style>

<section class="contact-area section-padding-50">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Area -->
            <div class="col-12 col-md-12 col-lg-12">
                <h4>History</h4>


                <ul class="timeline">
                    <li>
                        <div class="timeline-badge warning">2013</div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">생활코딩 PHP 수다 모임</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2013. 02.
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">페이스북 비공개 그룹 Modern PHP 개설</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2013. 04.
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge danger">
                            <i class="glyphicon glyphicon-credit-card"></i>
                            2014
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"> Modern PHP User Group X월 모임으로 모임명 변경</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2014. 10
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Modern PHP User Group Workshop 2014.</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2014. 11
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge info">
                            2015
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">PHP The Right Way 한글판 공동 관리 시작</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2015. 02.
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">컴포저 매뉴얼 공동 번역</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2015. 03
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"> 2015년 상반기 워크샵</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2015. 04. 17 ~ 18
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"> 슬랙 개설</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2015. 06
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">페이스북 공개 그룹 Modern PHP User Group 으로 이전</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2015. 07
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-badge success">
                            2016
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">위키와 Q&A 오픈</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2016. 01
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Community Open Camp at Microsoft 참가</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2016. 04. 09
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">컨플루언스를 이용한 위키와 Q&A 오픈.</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2016. 07
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge primary">
                            2019
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">홈페이지(modernpug.org) 리뉴얼</h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        2019. 01
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <p></p>
                            </div>
                        </div>
                    </li>


                </ul>


            </div>
        </div>
    </div>
</section>
