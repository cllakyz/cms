<div role="tabpanel" class="tab-pane fade" id="tab-4">
    <div class="form-group">
        <label>Vizyon</label>
        <textarea name="vision" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("vision") : $item->vision; ?></textarea>
    </div>
</div>