<!-- <div class="modal" id="insert_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" id="insert-form">
              <input type="hidden" id="id" name="id" />
              <label>Firstame</label>
              <input type="text" name="fname" id="fname" class="form-control" require>
              <label>Lastname</label>
              <input type="text" name="lname" id="lname" class="form-control" require>
              <label>Email</label>
              <input type="email" name="email" id="email" class="form-control" require>
              <label>Web</label>
              <input type="url" name="web" id="web" class="form-control" require>
              <br/>
              <input type="submit" id="insert" class="btn btn-success">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary reset-data" data-dismiss="modal">Close</button>
    </div>
  </div>
</div> -->

<div class="modal" tabindex="-1" id="insert_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header position-relative">
        <button type="button" class="btn-close position-absolute start-0 top-50 translate-middle-y" data-dismiss="modal" aria-label="Close"></button>
        <h5 class="modal-title w-100 text-center">Insert Data</h5>
      </div>

      <div class="modal-body">
          <form method="post" id="insert-form">
              <input type="hidden" id="id" name="id" />
              <label>عنوان</label>
              <input type="text" name="title" id="title" class="form-control" required>
              <label>توضیحات</label>
              <!-- <input type="text" name="description" id="description" class="form-control" required> -->
              <textarea name="description" id="description" class="form-control" rows="4" required></textarea>

              <!-- <label>Email</label>
              <input type="email" name="email" id="email" class="form-control" require>
              <label>Web</label>
              <input type="url" name="web" id="web" class="form-control" require> -->
              <br/>
              <!-- <input type="submit" id="insert" class="btn btn-success"> -->
          </form>
      </div>

       <div class="modal-footer d-flex justify-content-end">
        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>

        <button type="submit" form="insert-form" id="insert" class="btn btn-success ms-2">
          ارسال
        </button>
      </div>

      
    </div>
  </div>
</div>