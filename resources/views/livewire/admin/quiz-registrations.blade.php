<div wire:poll.3s class="min-h-screen bg-gradient-to-br from-[#96EDF7]/10 via-white to-[#96EDF7]/20 p-8">
    <div class="mx-auto max-w-7xl">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="mb-2 text-4xl font-bold text-[#042445]">
                        Quiz Registraties
                    </h1>
                    <p class="text-[#042445]/70">
                        Overzicht van alle aanmeldingen voor de Scheveningse Pubquiz
                    </p>
                </div>
                <div class="flex items-center gap-2 rounded-full bg-green-100 px-4 py-2 text-sm font-medium text-green-700">
                    <span class="relative flex h-3 w-3">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
                    </span>
                    Live
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="mb-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-[#96EDF7]/30 p-3">
                        <svg class="size-6 text-[#032EFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-[#042445]/70">
                            Totaal Teams
                        </p>
                        <p class="text-2xl font-bold text-[#032EFF]">
                            {{ $registrations->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-[#96EDF7]/30 p-3">
                        <svg class="size-6 text-[#032EFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-[#042445]/70">
                            Bezette Plekken
                        </p>
                        <p class="text-2xl font-bold text-[#032EFF]">
                            {{ $filledSpots }} / {{ $totalSpots }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-[#96EDF7]/30 p-3">
                        <svg class="size-6 text-[#032EFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-[#042445]/70">
                            Beschikbare Plekken
                        </p>
                        <p class="text-2xl font-bold text-[#032EFF]">
                            {{ $remainingSpots }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-8 rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg">
            <h2 class="mb-4 text-lg font-semibold text-[#042445]">
                Bezetting
            </h2>
            <div class="relative h-4 overflow-hidden rounded-full bg-[#96EDF7]/30">
                <div
                    class="h-full rounded-full bg-gradient-to-r from-[#032EFF] to-[#032EFF]/80 transition-all duration-1000"
                    style="width: {{ $fillPercentage }}%"
                ></div>
            </div>
            <p class="mt-2 text-center text-sm text-[#042445]/70">
                {{ $filledSpots }} van {{ $totalSpots }} plekken bezet ({{ number_format($fillPercentage, 1) }}%)
            </p>
        </div>

        {{-- Registrations Table --}}
        <div class="rounded-xl border border-[#032EFF]/20 bg-white/90 shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#032EFF]/20">
                            <th class="p-4 text-left text-sm font-semibold text-[#042445]">
                                Team Naam
                            </th>
                            <th class="p-4 text-left text-sm font-semibold text-[#042445]">
                                Contactpersoon
                            </th>
                            <th class="p-4 text-left text-sm font-semibold text-[#042445]">
                                E-mail
                            </th>
                            <th class="p-4 text-left text-sm font-semibold text-[#042445]">
                                Team Grootte
                            </th>
                            <th class="p-4 text-left text-sm font-semibold text-[#042445]">
                                Aangemeld op
                            </th>
                            <th class="p-4 text-left text-sm font-semibold text-[#042445]">
                                Acties
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                            <tr class="border-b border-[#032EFF]/10 transition-colors hover:bg-[#96EDF7]/10" wire:key="{{ $registration->id }}">
                                <td class="p-4 font-medium text-[#042445]">
                                    {{ $registration->name }}
                                </td>
                                <td class="p-4 text-[#042445]/80">
                                    {{ $registration->contact_name }}
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2 text-[#042445]/80">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                        {{ $registration->email }}
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2 text-[#042445]/80">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                        {{ $registration->team_size }}
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2 text-[#042445]/80">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>
                                        {{ $registration->created_at->format('d-m-Y H:i') }}
                                    </div>
                                </td>
                                <td class="p-4">
                                    <button
                                        wire:click="delete({{ $registration->id }})"
                                        wire:confirm="Weet je zeker dat je de inschrijving van '{{ $registration->name }}' wilt verwijderen?"
                                        class="rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-700 transition-colors hover:bg-red-200"
                                    >
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-[#042445]/70">
                                    Nog geen registraties
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
