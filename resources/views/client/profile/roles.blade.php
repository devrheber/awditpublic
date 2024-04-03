@extends('layouts.app')
@section('title', 'User Roles')
@section('content')

    <div style="padding-left: 80px">
        <div class="global_wrapper ">
            <x-title-section title='user' section='Roles' subtitle='Roles' />
            <x-view-profile-edit-card title="{{ __('message.roles_in_questionnaire') }}" dataTarget="#addrolemodal" buttonText="{{ __('message.add_role') }}"
                :showBorderBottom="false" class="{{ $clientroles->count() > 0 ? 'no-padding' : '' }}" faIcon="fa fa-user-plus"
                extraClasses="">
                @if ($clientroles->count() > 0)
                    {{-- <p>{{ ($clientroles) }}</p> --}}
                    <table class="table  " class="pl-3 pr-2">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('message.photo') }}</th>
                                <th scope="col">{{ __('message.name') }}</th>
                                <th scope="col">{{ __('message.email') }}</th>
                                <th scope="col">{{ __('message.Job Title') }}</th>
                                <th scope="col">ROLE</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientroles as $client)
                                <tr>

                                    <td class=" align-middle">
                                        @if ($client->image != null)
                                            <img style="width: 50px" class="rounded-circle"
                                                src=" {{ asset('images/client/profile') . '/' . $client->image }}">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class=" align-middle">
                                        @if ($client->first_name != null && $client->first_name != null)
                                            {{ $client->first_name }} {{ $client->last_name }}
                                        @elseif($client->first_name != null)
                                            {{ $client->first_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class=" align-middle">{{ $client->email }}</td>
                                    <td class=" align-middle">{{ $client->job_title }}</td>
                                    <td class=" align-middle">{{ $client->userRole->name }}</td>
                                    <td class=" align-middle">
                                        <div class="row">
                                            @php
                                                // Crear un nuevo objeto con solo los campos necesarios
                                                $clientData = new stdClass();
                                                $clientData->email = $client->email;
                                                $clientData->user_role = $client->id;
                                                $clientDataJson = json_encode($clientData);
                                            @endphp
                                            <button id="editRoleInQuestionnaire" type="button"
                                                class="btn btn-change-password d-flex align-items-center mr-2"
                                                data-client="{{ $clientDataJson }}">
                                                <i class="fa fa-edit"></i>
                                                <span>{{ __('message.edit') }}</span>
                                            </button>


                                            <button type="button"
                                                class="btn btn-change-password d-flex align-items-center ml-2"
                                                data-toggle="modal" data-target="#deleterolemodal"
                                                style="border: 2px solid #E24042;">
                                                <i class="fa fa-remove text-danger"></i>
                                                <span class="text-danger">{{ __('message.delete') }}</span>
                                            </button>
                                        </div>
                                        {{-- <a href="#" class="btn btn-modal-update mr-3 " id="{{ $client->id }}">Change
                                            Role</a>
                                        <a class="btn btn-modal-delete "
                                            href="{{ route('client.delete.client', $client->id) }}"
                                            onclick="return confirm('are you sure, you want to delete...?')"`><i
                                                class="fa fa-trash"></i></a> --}}
                                    </td>
                                    {{-- <td class=" align-middle"> --}}

                                    {{-- <a href="#" class="btn btn-modal-update mr-3 " id="{{ $client->id }}">Change
                                            Role</a>
                                        <a class="btn btn-modal-delete "
                                            href="{{ route('client.delete.client', $client->id) }}"
                                            onclick="return confirm('are you sure, you want to delete...?')"`><i
                                                class="fa fa-trash"></i></a> --}}
                                    {{-- </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(document).on('change', '#edit_userrole', function() {
                            var id = $(this).val();
                            console.log(id)
                            var url = "{{ route('client.show.description', ':id') }}";
                            url = url.replace(':id', id);
                            $.ajax({
                                type: "get",
                                url: url,
                                success: function(res) {
                                    var string = "";
                                    $.each(res, function(key, value) {

                                        string = string + value.permission.name + ',';

                                        $('#edit_client_role_description').val(string);
                                    });
                                },
                            });
                        });
                    </script>
                    <script>
                        $(document).on('click', '#editRoleInQuestionnaire', function() {
                            // Obtener los datos del cliente del atributo de datos
                            var clientData = $(this).data('client');
                            console.log(clientData);
                            $('#editroleinquestionnaire #email').val(clientData.email);

                            $('#edit_userrole').val(clientData.user_role_id);

                            var actionUrl = '{{ route('client.edit.client') }}';

                            var url = "{{ route('client.show.description', ':id') }}";
                            url = url.replace(':id', clientData.user_role_id);
                            $.ajax({
                                type: "get",
                                url: url,
                                success: function(res) {
                                    var string = "";
                                    $.each(res, function(key, value) {

                                        string = string + value.permission.name + ',';

                                        $('#edit_client_role_description').val(string);
                                    });
                                },
                            });



                            $('#editroleinquestionnaire').attr('action', actionUrl);


                            // Abrir el modal
                            $('#editroleinquestionnaire').modal('show');
                        });
                    </script>
                @else
                    <div class="mt-auto mb-auto ml-0">
                        No any client role is available
                    </div>
                @endif
            </x-view-profile-edit-card>
            <div class="mt-3"></div>
            <x-view-profile-edit-card id="viewProfileEditCard" title="{{ __('message.pending_roles_in_questionnaire') }}"
                dataTarget="#edit_brand" noIconOrButton='true' :showBorderBottom="false"
                class="{{ $pendingclients->count() > 0 ? 'no-padding' : '' }} " id='select_pending_client'>
                @if ($pendingclients->count() > 0)
                    <table class="table">
                        <thead>
                            <tr class="border-top: none">
                                <th scope="col">{{ __('message.email') }}</th>
                                <th scope="col">ROLE</th>
                                <th scope="col">{{ __('message.requested_date') }}</th>
                                <th scope="col">{{ __('message.expired_date') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody class=" align-items-center mr-3 ml-0 pr-2  mt-2 mb-2">
                            @foreach ($pendingclients as $client)
                                <tr>

                                    <td class="align-middle">{{ $client->email }}</td>
                                    <td class="align-middle">{{ $client->userRole->name }}</td>
                                    <td class="align-middle">{{ $client->send_date }}</td>
                                    <td class="align-middle">{{ $client->expired_date }}</td>
                                    <td class="align-middle">
                                        <div class="row">
                                            <button id="editButton" type="button"
                                                class="btn btn-change-password d-flex align-items-center mr-2"
                                                data-client="{{ json_encode($client) }}">
                                                <i class="fa fa-edit"></i>
                                                <span>{{ __('message.edit') }}</span>
                                            </button><button type="button"
                                                class="btn btn-change-password d-flex align-items-center ml-2"
                                                data-toggle="modal" data-target="#deleterolemodal"
                                                style="color: #E24042 !important; border: 2px solid #E24042;">
                                                <i class="fa fa-remove"></i>
                                                <span>{{ __('message.delete') }}</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <script>
                        $(document).on('change', '#edit_userrole', function() {
                            var id = $(this).val();
                            console.log(id)
                            var url = "{{ route('client.show.description', ':id') }}";
                            url = url.replace(':id', id);
                            $.ajax({
                                type: "get",
                                url: url,
                                success: function(res) {
                                    var string = "";
                                    $.each(res, function(key, value) {

                                        string = string + value.permission.name + ',';

                                        $('#edit_description').val(string);
                                    });
                                },
                            });
                        });
                    </script>
                    <script>
                        $(document).on('click', '#editButton', function() {
                            // Obtener los datos del cliente del atributo de datos
                            var clientData = $(this).data('client');
                            console.log(clientData);
                            // Mostrar los datos del cliente en el modal

                            $('#editpendingclientrole #email').val(clientData.email);

                            // Otros campos del cliente que puedas tener en el modal
                            $('#edit_userrole').val(clientData.user_role_id);

                            // Obtener el ID del usuario
                            var userId = clientData.id;

                            // Actualizar el valor del atributo 'action' del componente x-modal
                            var actionUrl = '{{ route('client.update.pending.client', ':userId') }}';
                            actionUrl = actionUrl.replace(':userId', userId);
                            $('#editpendingclientrole').attr('action', actionUrl);

                            // Abrir el modal
                            $('#editpendingclientrole').modal('show');
                        });
                    </script>
                @else
                    <div class="mt-auto mb-auto ml-0">
                        No any pending client role is available
                    </div>
                @endif
            </x-view-profile-edit-card>
        </div>
    </div>


    <x-modal title="{{ __('message.edit_pending_client_role') }}" id="editpendingclientrole"
        action="{{ route('client.update.pending.client', 1) }}">


        <input type="hidden" name="userid" id="userid">
        <div class="form-group">
            <label for="email">{{ __('message.email') }}</label>
            <input type="email" name="email" class="form-control" id="email">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <select class="form-control selecttwodropdown" name="role" id="edit_userrole">
                @foreach ($userroles as $role)
                    <option value="{{ $role->id }}"> {{ $role->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{-- <label for="usr"></label> --}}
            <textarea class="form-control" rows="5" id="edit_description"></textarea>
        </div>
    </x-modal>
    <x-modal title="{{ __('message.edit_client_role') }}" id="editroleinquestionnaire" action="{{ route('client.update.pending.client', 0) }}">

        <input type="hidden" name="userid" id="userid">
        <div class="form-group">
            <label for="email">{{ __('message.email') }}</label>
            <input type="email" name="email" class="form-control" id="email" value="">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <select class="form-control selecttwodropdown" name="role" id="edit_userrole">
                @foreach ($userroles as $role)
                    <option value="{{ $role->id }}"> {{ $role->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{-- <label for="usr"></label> --}}
            <textarea class="form-control" rows="5" id="edit_client_role_description"></textarea>
        </div>
    </x-modal>
    <x-modal title="{{ __('message.delete_role') }}" saveButtonName="Accept" id="deleterolemodal">
        {{ __('message.message_delete_record_question') }}
    </x-modal>
    {{-- add role modal start --}}
    <x-modal title="{{ __('message.add_role') }}" id="addrolemodal" saveButtonName="{{ __('message.add') }}" action="{{ route('client.create.client') }}">
        <div class="modal-body">
            <div class="form-group">
                <label for="email">{{ __('message.email') }}</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="userrole">{{ __('message.select_a_role') }}</label>
                <select class="form-control selecttwodropdown" name="role" id="userrole">
                    @foreach ($userroles as $role)
                        <option value="{{ $role->id }}"> {{ $role->name }} </option>
                    @endforeach
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">{{ __('message.description') }}</label>
                <textarea class="form-control" id="description" rows="6" style="resize:none"></textarea>
            </div>
        </div>
        {{-- TODO USAR ESTO EN EL X-MODAL --}}
        <!-- Modal footer -->
        {{-- <div class="modal-footer">
            <button type="submit" class="btn btn-primary brand-secondary-color" id="userCreate">save</button>
            <button type="button" class="btn btn-danger brand-secondary-color" data-dismiss="modal">Close</button>
        </div> --}}
    </x-modal>

    <script>
        $(document).ready(function() {
            console.log('holaaa')

            $(document).on('change', '#edit_userrole', function() {
                var id = $(this).val();
                console.log(id)
                var url = "{{ route('client.show.description', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(res) {
                        var string = "";
                        $.each(res, function(key, value) {

                            string = string + value.permission.name + ',';

                            $('#edit_description').val(string);
                        });
                    },
                });
            });

            $(".edit_role_btn").click(function() {
                var id = $(this).attr('id');
                $('#userid').val(id);
                $("#editrolemodal").modal('show');
            });
        });
    </script>

@endsection
