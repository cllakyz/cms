<div role="tabpanel" class="tab-pane fade" id="tab-3">
    <div class="form-group">
        <label>Misyon</label>
        <textarea name="mission" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("mission") : $item->mission; ?></textarea>
    </div>
</div>