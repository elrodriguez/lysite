<div class="">
    <div class="container page__container">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME','Laravel') }}</a></li>
            <li class="breadcrumb-item active">{{ __('academic::labels.students') }}</li>
        </ol>
    </div>
    <div class="container page__container">
        <div class="col-lg-12 p-0 mx-auto">
            <div class="card card-body mb-32pt">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <!-- Wrapper -->
                        <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                            <!-- Search -->
                            
                            <!-- Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tipo documento</th>
                                        <th>Número</th>
                                        <th>Nombre Completo</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @php
                                        $total = 1;
                                    @endphp
                                    @foreach($students as $key => $student)
                                        <tr>
                                            <td class="name align-middle">{{ $student->document_type_name }}</td>
                                            <td class="name align-middle">{{ $student->number }}</td>
                                            <td class="name align-middle">{{ $student->full_name }}</td>
                                            <td class="name align-middle">{{ $student->mobile_phone }}</td>
                                            <td class="name align-middle">{{ $student->email }}</td>
                                        </tr>
                                        @php
                                            $total = $total + 1;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right align-middle">TOTAL</td>
                                        <td class="text-center align-middle">{{ $total }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>