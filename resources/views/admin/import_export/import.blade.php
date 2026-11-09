<div class="content-bg">
    <div class="row">
        <div class="col-12 my-2">
            <div class="border-bottom">
                <div class="nav nav-tabs align-items-center border-0 bg-white d-inline-flex rounded-3 mx-2" id="v-pills-tab" role="tablist">
                    <a class="nav-link nav-s active text-center align-items-center icon-img"
                        id="import-data-tab" data-toggle="pill" href="#import-data" role="tab" aria-controls="import-data"
                        aria-selected="true">
                        <i class="fa-solid fa-file-import menuu-icon"></i><span class="menuu-text">Import Data</span>
                    </a>
                    <a class="nav-link nav-s text-center align-items-center icon-img" id="export-data-tab"
                        data-toggle="pill" href="#export-data" role="tab" aria-controls="export-data" aria-selected="false">
                        <i class="fa-solid fa-file-export menuu-icon"></i><span class="menuu-text">Export Data</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="tab-content border-0">
                <div class="tab-pane fade show active" id="import-data" role="tabpanel" aria-labelledby="import-data-tab">
                    <div>
                        <div class="p-2">
                            <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-file-import headings-icon"></i>Import Data</label>
                        </div>
                        <div class="row mx-0 px-2 mb-2">
                            <div class="col-12 bg-white rounded-3 px-0 mb-2">
                                <div class="d-flex justify-content-end pt-2 px-2">
                                    <button class="btn web-btn"><i class="bi bi-download"></i> Download file</button>
                                </div>
                                <div class="row p-2 mx-0">
                                    <div class="p-3 text-center dashed-border">
                                        <div class="input-group my-2 col-sm-4 mx-auto">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" />
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                        <h4 class="pt-2">Drop a csv or excel file here or browse</h4>
                                    </div>
                                </div>

                                <div class="form-group row mx-0 align-items-center">
                                    <label for="exampleTextarea1" class="col-form-label my-2 py-0 px-2">Import description. (Note that you can copy/paste data from Excel directly)</label>
                                    <div class="px-2 pb-2">
                                        <textarea class="form-control" id="exampleTextarea1" placeholder="" rows="25"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="text-center my-2">
                                        <button class="btn web-btn mr-2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Import
                                        </button>
                                        <button type="button" class="btn cancel-btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>