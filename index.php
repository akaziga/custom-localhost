<!DOCTYPE html>
<html>
    <head>
        <title>akaziga localhost</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
              integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap');

            body {
                font-family: 'Roboto Condensed', sans-serif;
                color: #ffffff;
                background: #222222;
                /*font-size: 14px;*/
            }

            a {
                color: #ffffff;
            }

            .header {
                background: #000000;
            }

            h2 {
                margin-bottom: 0;
                color: #ffffff;
            }
            .card {
                border-radius: 0;
                background: #222222;
                border: none;
                -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.95);
                -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.95);
                box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.95);
            }
            a:hover {
                color: #28a745;
            }
            .project-title {
                font-weight: 500;
                /*background: #000000;*/
            }
            .btn {
                padding: 0.1rem 0.75rem;
            }
            .badge {
                font-size: 70%;
            }
            .card-body {
                padding: 1.750rem 0.75rem;
            }
            .mark,
            mark {
                padding: .2em;
                background-color: yellow;
            }
            i {
                font-size: 10px;
            }
            .header-left {
                display: flex;
                align-items: center;
            }
            .header-image {
                width: 3rem;
                border-radius: 50%;
            }
            p {
                margin-bottom: 0.250rem;
            }
            .text-secondary {
                color: #99a0a7 !important;
            }
            .d-flex-align-center {
                display: flex;
                align-items: center;
            }
            .form-control {
                display: block;
                width: 100%;
                height: calc(1.5em + .75rem + 2px);
                padding: .375rem .75rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #495057;
                background-color: transparent;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: .25rem;
                transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div id="project-list" class="project-list">
                <div class="row header p-3">
                    <div class="col-sm-8 header-left pt-1">
                        <?php
                        $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        ?>
                        <h2 class="header-title">There is no place like <small><?php echo GetHostByName($ip); ?></small>
                        </h2>
                    </div>
                    <div class="col-sm-2 pt-1">
                        <input class="search form-control" placeholder="Filtro..." autofocus />
                    </div>
                    <div class="col-sm-2 pt-1">
                        <form>
                            <input type="text" name="keyword" class="form-control" placeholder="Pesquisa...">
                        </form>
                    </div>
                </div>
                <div class="row list">
                    <?php
                    $dirFiles = array();
                    $ignore_files = array('.', '..', '.DS_Store');
                    if ($handle = opendir('.')) {
                        while (false !== ($file = readdir($handle))) {
                            $newstring = str_replace($ignore_files, " ", $file);
                            if (!in_array($file, $ignore_files)) {
                                $dirFiles[] = $file;
                            }
                        }
                        closedir($handle);
                    }
                    sort($dirFiles);
                    foreach ($dirFiles as $file) {
                        ?>
                        <div class="card col-sm-4 col-lg-2 ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="project-title">
                                            <a href="<?php echo $file; ?>" target="_blank">
                                                <?php echo $file; ?> <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <?php
                                        $time = filemtime($file);
                                        $last_modified_str = date("Y-m-d", $time);
                                        ?>
                                        <p>
                                            <small class="text-secondary mr-2">Last modify: <?php echo $last_modified_str; ?></small></p>
                                        <?php if (strpos($file, '.dev') !== false) :
                                            ?>
                                            <p><small class="badge badge-success">Projecto Local</small></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/mark.js/8.6.0/mark.min.js"></script>
        <script>
            var markInstance = new Mark(document.querySelector(".project-list"));
            var keywordInput = document.querySelector("input[name='keyword']");
            var optionInputs = document.querySelectorAll("input[name='opt[]']");

            function performMark() {
                var keyword = keywordInput.value;
                var options = {};
                [].forEach.call(optionInputs, function (opt) {
                    options[opt.value] = opt.checked;
                });
                markInstance.unmark({
                    done: function () {
                        markInstance.mark(keyword, options);
                    }
                });
            }
            ;
            keywordInput.addEventListener("input", performMark);
            for (var i = 0; i < optionInputs.length; i++) {
                optionInputs[i].addEventListener("change", performMark);
            }
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
        <script>
            var options = {
                valueNames: ['project-title']
            };
            var userList = new List('project-list', options);
        </script>
    </body>
</html>
