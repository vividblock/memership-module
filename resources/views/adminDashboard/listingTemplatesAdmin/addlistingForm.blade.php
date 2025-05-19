@include('includes.admin.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Listing</h1>

    </div>

        <!-- Main Content -->
    <div class="card p-4">
        <div class="card-header mb-3">
            <h6 class="h6 mb-0 text-gray-800 admindash-headings">Add Listing</h4>
        </div>
      
      <div class="row">
        <!-- Left Column (Excerpt, Custom Fields etc) -->
        <div class="col-md-8">
            <div class="panel">
                <input type="text" class="form-control mb-3" placeholder="Enter title here">

                <script src="https://cdn.tiny.cloud/1/w12g53mmdhlettmiu1p1nuqses3oqpjy97vxit63v7umnlit/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                tinymce.init({
                    selector: '#listing-description-textarea',
                    plugins: [
                    // Core editing features
                    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                    // Your account includes a free trial of TinyMCE premium features
                    // Try the most popular premium features until Jun 2, 2025:
                    'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
                    ],
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [
                    { value: 'First.Name', title: 'First Name' },
                    { value: 'Email', title: 'Email' },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
                });
                </script>
                <textarea id="listing-description-textarea"></textarea>
            </div>
            
            <div class="panel">
                <div class="panel-title">
                    
                </div>
            </div>
        </div>

        <!-- Right Column (Publish, Format, Categories) -->
        <div class="col-md-4">
          <div class="publish-box">
            <h5>Publish</h5>
            <button class="btn btn-secondary btn-sm mb-2">Save Draft</button>
            <div>Status: <strong>Draft</strong></div>
            <div>Visibility: <strong>Public</strong></div>
            <div>Publish: <strong>Immediately</strong></div>
            <button class="btn btn-danger btn-sm mt-2">Move to Trash</button>
            <button class="btn btn-primary w-100 mt-2">Publish</button>
          </div>

          <div class="format-box">
            <h5>Format</h5>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="format" checked>
              <label class="form-check-label">Standard</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="format">
              <label class="form-check-label">Image</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="format">
              <label class="form-check-label">Quote</label>
            </div>
          </div>

          <div class="category-box">
            <h5>Categories</h5>
            <div class="form-check">
              <input class="form-check-input" type="checkbox">
              <label class="form-check-label">Uncategorized</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox">
              <label class="form-check-label">News</label>
            </div>
            <input type="text" class="form-control mt-2" placeholder="+ Add New Category">
          </div>

        </div>
      </div>

    </div>


</div>



@include('includes.admin.footer')