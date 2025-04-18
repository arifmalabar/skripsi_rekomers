<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">@yield('modal-title')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @yield('modal-body')
        </div>
        <div class="modal-footer justify-content-between">
            @yield('modal-footer')
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->