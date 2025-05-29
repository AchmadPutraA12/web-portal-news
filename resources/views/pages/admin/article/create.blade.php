<div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formArticle">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addArticleModalLabel">Tambah Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <input type="text" name="content" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="content_article" class="form-label">Content Article <span
                                class="text-danger">*</span></label>
                        <input type="text" name="content_article" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="layout" class="form-label">Layout <span class="text-danger">*</span></label>
                        <select name="layout" class="form-control" required>
                            <option value="">-- Pilih Layout --</option>
                            <option value="1">Layout 1(Gambar Sebelum Teks)</option>
                            <option value="2">Layout 2(Gambar Setelah Teks)</option>
                            <option value="3">Layout 3(Gambar Setelah Teks)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image_1" class="form-label">Gambar 1 <span class="text-danger">*</span></label>
                        <input type="file" name="image_1" class="form-control">
                    </div>
                    <div class="mb-3" id="image_2_group">
                        <label for="image_2" class="form-label">Gambar 2</label>
                        <input type="file" name="image_2" class="form-control">
                    </div>
                    <div class="mb-3" id="image_3_group">
                        <label for="image_3" class="form-label">Gambar 3</label>
                        <input type="file" name="image_3" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
