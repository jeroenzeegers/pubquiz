import { Head } from '@inertiajs/react';
import { Calendar, Mail, Users } from 'lucide-react';

interface QuizRegistration {
    id: number;
    name: string;
    contact_name: string;
    team_size: number;
    email: string;
    created_at: string;
}

interface Props {
    registrations: QuizRegistration[];
    totalSpots: number;
    filledSpots: number;
    remainingSpots: number;
}

export default function AdminQuizRegistrationsIndex({
    registrations,
    totalSpots,
    filledSpots,
    remainingSpots,
}: Props) {
    const fillPercentage = (filledSpots / totalSpots) * 100;

    return (
        <>
            <Head title="Quiz Registraties - Admin" />
            <div className="min-h-screen bg-gradient-to-br from-[#96EDF7]/10 via-white to-[#96EDF7]/20 p-8 dark:from-[#042445] dark:via-[#042445]/90 dark:to-[#032EFF]/10">
                <div className="mx-auto max-w-7xl">
                    {/* Header */}
                    <div className="mb-8">
                        <h1 className="mb-2 text-4xl font-bold text-[#042445] dark:text-[#96EDF7]">
                            Quiz Registraties
                        </h1>
                        <p className="text-[#042445]/70 dark:text-[#96EDF7]/70">
                            Overzicht van alle aanmeldingen voor de Scheveningse Pubquiz
                        </p>
                    </div>

                    {/* Stats Cards */}
                    <div className="mb-8 grid gap-6 md:grid-cols-3">
                        <div className="rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg dark:border-[#032EFF]/30 dark:bg-[#042445]/90">
                            <div className="flex items-center gap-4">
                                <div className="rounded-lg bg-[#96EDF7]/30 p-3 dark:bg-[#032EFF]/20">
                                    <Users className="size-6 text-[#032EFF] dark:text-[#96EDF7]" />
                                </div>
                                <div>
                                    <p className="text-sm font-medium text-[#042445]/70 dark:text-[#96EDF7]/70">
                                        Totaal Teams
                                    </p>
                                    <p className="text-2xl font-bold text-[#032EFF] dark:text-[#EDD100]">
                                        {registrations.length}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg dark:border-[#032EFF]/30 dark:bg-[#042445]/90">
                            <div className="flex items-center gap-4">
                                <div className="rounded-lg bg-[#96EDF7]/30 p-3 dark:bg-[#032EFF]/20">
                                    <Users className="size-6 text-[#032EFF] dark:text-[#96EDF7]" />
                                </div>
                                <div>
                                    <p className="text-sm font-medium text-[#042445]/70 dark:text-[#96EDF7]/70">
                                        Bezette Plekken
                                    </p>
                                    <p className="text-2xl font-bold text-[#032EFF] dark:text-[#EDD100]">
                                        {filledSpots} / {totalSpots}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg dark:border-[#032EFF]/30 dark:bg-[#042445]/90">
                            <div className="flex items-center gap-4">
                                <div className="rounded-lg bg-[#96EDF7]/30 p-3 dark:bg-[#032EFF]/20">
                                    <Users className="size-6 text-[#032EFF] dark:text-[#96EDF7]" />
                                </div>
                                <div>
                                    <p className="text-sm font-medium text-[#042445]/70 dark:text-[#96EDF7]/70">
                                        Beschikbare Plekken
                                    </p>
                                    <p className="text-2xl font-bold text-[#032EFF] dark:text-[#EDD100]">
                                        {remainingSpots}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Progress Bar */}
                    <div className="mb-8 rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-lg dark:border-[#032EFF]/30 dark:bg-[#042445]/90">
                        <h2 className="mb-4 text-lg font-semibold text-[#042445] dark:text-[#96EDF7]">
                            Bezetting
                        </h2>
                        <div className="relative h-4 overflow-hidden rounded-full bg-[#96EDF7]/30 dark:bg-[#032EFF]/20">
                            <div
                                className="h-full rounded-full bg-gradient-to-r from-[#032EFF] to-[#032EFF]/80 transition-all duration-1000 dark:from-[#EDD100] dark:to-[#EDD100]/80"
                                style={{ width: `${fillPercentage}%` }}
                            />
                        </div>
                        <p className="mt-2 text-center text-sm text-[#042445]/70 dark:text-[#96EDF7]/70">
                            {filledSpots} van {totalSpots} plekken bezet ({fillPercentage.toFixed(1)}%)
                        </p>
                    </div>

                    {/* Registrations Table */}
                    <div className="rounded-xl border border-[#032EFF]/20 bg-white/90 shadow-lg dark:border-[#032EFF]/30 dark:bg-[#042445]/90">
                        <div className="overflow-x-auto">
                            <table className="w-full">
                                <thead>
                                    <tr className="border-b border-[#032EFF]/20 dark:border-[#032EFF]/30">
                                        <th className="p-4 text-left text-sm font-semibold text-[#042445] dark:text-[#96EDF7]">
                                            Team Naam
                                        </th>
                                        <th className="p-4 text-left text-sm font-semibold text-[#042445] dark:text-[#96EDF7]">
                                            Contactpersoon
                                        </th>
                                        <th className="p-4 text-left text-sm font-semibold text-[#042445] dark:text-[#96EDF7]">
                                            E-mail
                                        </th>
                                        <th className="p-4 text-left text-sm font-semibold text-[#042445] dark:text-[#96EDF7]">
                                            Team Grootte
                                        </th>
                                        <th className="p-4 text-left text-sm font-semibold text-[#042445] dark:text-[#96EDF7]">
                                            Aangemeld op
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {registrations.length === 0 ? (
                                        <tr>
                                            <td
                                                colSpan={5}
                                                className="p-8 text-center text-[#042445]/70 dark:text-[#96EDF7]/70"
                                            >
                                                Nog geen registraties
                                            </td>
                                        </tr>
                                    ) : (
                                        registrations.map((registration) => (
                                            <tr
                                                key={registration.id}
                                                className="border-b border-[#032EFF]/10 transition-colors hover:bg-[#96EDF7]/10 dark:border-[#032EFF]/20 dark:hover:bg-[#032EFF]/10"
                                            >
                                                <td className="p-4 font-medium text-[#042445] dark:text-[#96EDF7]">
                                                    {registration.name}
                                                </td>
                                                <td className="p-4 text-[#042445]/80 dark:text-[#96EDF7]/80">
                                                    {registration.contact_name}
                                                </td>
                                                <td className="p-4">
                                                    <div className="flex items-center gap-2 text-[#042445]/80 dark:text-[#96EDF7]/80">
                                                        <Mail className="size-4" />
                                                        {registration.email}
                                                    </div>
                                                </td>
                                                <td className="p-4">
                                                    <div className="flex items-center gap-2 text-[#042445]/80 dark:text-[#96EDF7]/80">
                                                        <Users className="size-4" />
                                                        {registration.team_size}
                                                    </div>
                                                </td>
                                                <td className="p-4">
                                                    <div className="flex items-center gap-2 text-[#042445]/80 dark:text-[#96EDF7]/80">
                                                        <Calendar className="size-4" />
                                                        {new Date(registration.created_at).toLocaleDateString('nl-NL', {
                                                            day: '2-digit',
                                                            month: '2-digit',
                                                            year: 'numeric',
                                                            hour: '2-digit',
                                                            minute: '2-digit',
                                                        })}
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
