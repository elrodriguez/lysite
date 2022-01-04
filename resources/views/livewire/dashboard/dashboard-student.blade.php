<div>
    @if($registered_until)
    <div class="card border-left-4 border-left-accent card-sm mb-lg-32pt">
        <div class="card-body pl-16pt">
            <div class="media flex-wrap align-items-center">
                <div class="media-left">
                    <i class="material-icons text-50">access_time</i>
                </div>
                <div class="media-body" style="min-width: 180px">
                    Tu suscripción finaliza el <strong>{{ \Carbon\Carbon::parse($registered_until)->format('d').' '.nameMonth(\Carbon\Carbon::parse($registered_until)->format('m')).' '.\Carbon\Carbon::parse($registered_until)->format('Y') }} </strong>
                </div>
                <div class="media-right mt-2 mt-sm-0">
                    {{-- <a class="btn btn-link text-secondary" href="student-billing.html">Upgrade</a> --}}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
