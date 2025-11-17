<div class="modal fade" id="insert_modal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header position-relative">
        <h5 class="modal-title w-100 text-center" id="insertModalLabel">Insert Data</h5>
        <button type="button" class="btn-close position-absolute start-0 top-50 translate-middle-y" data-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="insert-form">
          <input type="hidden" id="id" name="id">
          <label>عنوان</label>
          <input type="text" name="title" id="title" class="form-control" required>
          <label>توضیحات</label>
          <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </form>
      </div>

      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
        <button type="submit" form="insert-form" id="insert" class="btn btn-success">ارسال</button>
      </div>
    </div>
  </div>
</div>
