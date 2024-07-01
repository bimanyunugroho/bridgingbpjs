<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service BPJS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>

    <div class="container-fluid mt-4">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-7">
                    <div class="card shadow p-3 mb-5 rounded">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <p>All Services Bridging BPJS</p>
                                <button id="toggle-dark-mode" class="btn btn-outline-secondary">Mode Malam</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="service" id="service" class="form-control service">
                                        <option value="0" style="background-color: antiquewhite;" disabled selected>DEVELOPMENT</option>
                                        <option value="vclaim-dev">VClaim V2</option>
                                        <option value="icare-dev">iCare</option>
                                        <option value="pcare-dev">Pcare</option>
                                        <option value="antreanfktp-dev">Antrean FKTP</option>
                                        <option value="0" style="background-color: antiquewhite;" disabled>PRODUCTION</option>
                                        <option value="vclaim">VClaim V2</option>
                                        <option value="icare">iCare</option>
                                        <option value="pcare">Pcare</option>
                                        <option value="antreanfktp">Antrean FKTP</option>
                                    </select>
                                </div>
                                <div class="col-md-4 hide_cons_id">
                                    <div class="form-floating">
                                        <input type="text" class="form-control cons_id" name="cons_id" id="cons_id" placeholder="Cons ID">
                                        <label for="cons_id">Cons ID</label>
                                    </div>
                                </div>
                                <div class="col-md-4 hide_secret_key">
                                    <div class="form-floating">
                                        <input type="text" class="form-control secret_key" name="secret_key" id="secret_key" placeholder="Secret Key">
                                        <label for="secret_key">Secret Key</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-6 hide_username">
                                    <div class="form-floating">
                                        <input type="text" class="form-control username" name="username" id="username" placeholder="Username">
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <div class="col-md-6 hide_password">
                                    <div class="form-floating">
                                        <input type="text" class="form-control password" name="password" id="password" placeholder="Password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12 hide_user_key">
                                    <div class="form-floating">
                                        <input type="text" class="form-control user_key" name="user_key" id="user_key" placeholder="User Key">
                                        <label for="user_key">User Key</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-3">
                                    <select id="method" class="form-control method" name="method" aria-label="Select method">
                                        <option value="GET" selected>GET</option>
                                        <option value="POST">POST</option>
                                        <option value="PUT">PUT</option>
                                        <option value="DELETE">DELETE</option>
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-floating">
                                        <input type="text" class="form-control url" name="url" id="url" value="" placeholder="URL" readonly>
                                        <label for="url">URL</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="text" class="form-control end_point" name="end_point" id="end_point" value="" placeholder="End Point">
                                        <label for="end_point">End Point</label>
                                    </div>
                                    <button class="btn btn-success" id="btnSend" type="button">Send</button>
                                    <button class="btn btn-primary" id="btnSaving" type="button">Save</button>
                                    <button class="btn btn-danger" id="btnDelete" type="button">Delete</button>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <p class="badge text-bg-primary body_params">Body Parameter</p>
                                        <input class="form-check-input mt-0 withParams" id="withParams" name="withParams" type="checkbox" value="">
                                    </div>
                                    <textarea name="params" id="params" class="form-control params" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card shadow p-3 mb-5 rounded">
                        <div class="card-header">
                            Responses Services Bridging BPJS
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <select id="behavior" class="form-control behavior" name="behavior" aria-label="Select behavior">
                                            <option value="0" selected>Expands</option>
                                            <option value="1">Collapses</option>
                                        </select>
                                        <button type="button" class="btn btn-primary" id="btnDetailData">
                                            Show In
                                        </button>
                                    </div>
                                </div>
                                <div id="tempResponse" class="mb-2 tempResponse"></div>
                                <div class="mode p-2">
                                    <div id="jsonResponse"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalJSON" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailResponseLabel" style="color: black;">Response</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <pre id="jsonResponseModal"></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnScreenshoot">Screenshoot</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="assets/js/json-viewer.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>