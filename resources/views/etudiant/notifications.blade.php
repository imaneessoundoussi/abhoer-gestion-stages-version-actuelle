@extends('layouts.etudiant')

@section('title', 'Notifications')

@section('page-title', 'Notifications')

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Notifications
            </h2>

            <p class="text-secondary mb-0">
                Consultez les informations concernant vos demandes de stage.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge rounded-pill bg-primary px-3 py-2">

                {{ $notificationsNonLues ?? 0 }}

                @if(($notificationsNonLues ?? 0) > 1)
                    notifications non lues
                @else
                    notification non lue
                @endif

            </span>
        </div>

    </div>


    {{-- Carte principale --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-bold mb-1">
                Mes notifications
            </h5>

            <p class="text-secondary small mb-0">
                Suivez les mises à jour relatives à vos demandes de stage.
            </p>

        </div>


        <div class="card-body p-4">

            @php
                $notifications = $notifications ?? collect();
            @endphp


            @if($notifications->count() > 0)

                @foreach($notifications as $notification)

                    <div class="border-bottom py-3">

                        <div class="d-flex align-items-start">

                            {{-- Icône --}}
                            <div class="me-3">

                                <div
                                    class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                    style="width:45px;height:45px;"
                                >
                                    <i class="bi bi-bell"></i>
                                </div>

                            </div>


                            {{-- Contenu --}}
                            <div class="flex-grow-1">

                                <h6 class="fw-bold mb-1">

                                    {{ $notification->titre ?? 'Notification' }}

                                </h6>


                                <p class="text-secondary mb-1">

                                    {{ $notification->message ?? '' }}

                                </p>


                                @if(!empty($notification->created_at))

                                    <small class="text-muted">

                                        {{ $notification->created_at }}

                                    </small>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach


            @else

                {{-- Aucune notification --}}
                <div class="text-center py-5">

                    <div
                        class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center mx-auto mb-4"
                        style="width:80px;height:80px;"
                    >

                        <i
                            class="bi bi-bell-slash"
                            style="font-size:32px;"
                        ></i>

                    </div>


                    <h5 class="fw-bold mb-2">
                        Aucune notification
                    </h5>


                    <p class="text-secondary mb-4">
                        Vous n'avez aucune nouvelle notification pour le moment.
                    </p>


                    <a
                        href="{{ route('etudiant.dashboard') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-arrow-left me-2"></i>

                        Retour au tableau de bord

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection