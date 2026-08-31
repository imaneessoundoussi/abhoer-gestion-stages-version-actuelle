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


    {{-- Message de succès --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- Carte principale --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Mes notifications
                    </h5>

                    <p class="text-secondary small mb-0">
                        Suivez les mises à jour relatives à vos demandes de stage.
                    </p>

                </div>

                @if(($notificationsNonLues ?? 0) > 0)

                    <form
                        method="POST"
                        action="{{ route('etudiant.notifications.lire-toutes') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-primary btn-sm"
                        >

                            <i class="bi bi-check2-all me-1"></i>

                            Tout marquer comme lu

                        </button>

                    </form>

                @endif

            </div>

        </div>


        <div class="card-body p-4">

            @php
                $notifications = $notifications ?? collect();
            @endphp


            @if($notifications->count() > 0)

                @foreach($notifications as $notification)

                    <div
                        class="border-bottom py-3
                        {{ !$notification->lu ? 'bg-light rounded px-3' : '' }}"
                    >

                        <div class="d-flex align-items-start">

                            {{-- Icône --}}
                            <div class="me-3">

                                <div
                                    class="rounded-circle
                                    {{ $notification->lu ? 'bg-secondary-subtle text-secondary' : 'bg-primary-subtle text-primary' }}
                                    d-flex align-items-center justify-content-center"
                                    style="width:45px;height:45px;"
                                >

                                    @if($notification->type === 'SUCCESS')

                                        <i class="bi bi-check-circle"></i>

                                    @elseif($notification->type === 'WARNING')

                                        <i class="bi bi-exclamation-triangle"></i>

                                    @elseif($notification->type === 'DANGER')

                                        <i class="bi bi-x-circle"></i>

                                    @else

                                        <i class="bi bi-bell"></i>

                                    @endif

                                </div>

                            </div>


                            {{-- Contenu --}}
                            <div class="flex-grow-1">

                                <div class="d-flex justify-content-between align-items-start">

                                    <h6 class="fw-bold mb-1">

                                        {{ $notification->titre ?? 'Notification' }}

                                        @if(!$notification->lu)

                                            <span class="badge bg-primary ms-2">
                                                Nouvelle
                                            </span>

                                        @endif

                                    </h6>

                                    @if(!$notification->lu)

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'etudiant.notifications.lire',
                                                $notification->idNotification
                                            ) }}"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-secondary"
                                                title="Marquer comme lue"
                                            >

                                                <i class="bi bi-check2"></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>


                                <p class="text-secondary mb-1">

                                    {{ $notification->message ?? '' }}

                                </p>


                                @if($notification->created_at)

                                    <small class="text-muted">

                                        <i class="bi bi-clock me-1"></i>

                                        {{ $notification->created_at->format('d/m/Y à H:i') }}

                                    </small>

                                @endif


                                @if($notification->idDemande)

                                    <div class="mt-2">

                                        <a
                                            href="{{ route(
                                                'etudiant.demandes.show',
                                                $notification->idDemande
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >

                                            <i class="bi bi-eye me-1"></i>

                                            Voir la demande

                                        </a>

                                    </div>

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
                        Vous n'avez aucune notification pour le moment.
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
