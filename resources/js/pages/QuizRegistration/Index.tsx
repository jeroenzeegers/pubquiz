import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, usePage } from '@inertiajs/react';
import { Form } from '@inertiajs/react';
import { Beer, Calendar, CheckCircle2Icon, Clock, Users } from 'lucide-react';

interface Props {
    remainingSpots: number;
}

export default function QuizRegistrationIndex({ remainingSpots }: Props) {
    const { flash } = usePage().props as any;
    const totalSpots = 60;
    const filledSpots = totalSpots - remainingSpots;
    const fillPercentage = (filledSpots / totalSpots) * 100;

    return (
        <>
            <Head title="Pubquiz Aanmelding" />
            <div className="flex min-h-screen flex-col items-center justify-center bg-gradient-to-br from-[#96EDF7]/20 via-white to-[#96EDF7]/30 p-6 dark:from-[#042445] dark:via-[#042445]/80 dark:to-[#032EFF]/20">
                <div className="w-full max-w-md">
                    {/* Header with staggered animation */}
                    <div className="mb-8 animate-in fade-in slide-in-from-top-4 text-center duration-700">
                        <div className="mb-4 inline-flex rounded-full bg-[#EDD100]/20 p-3 dark:bg-[#EDD100]/10">
                            <Beer className="size-8 text-[#032EFF] dark:text-[#96EDF7]" />
                        </div>
                        <h1 className="mb-3 text-5xl font-bold tracking-tight text-[#042445] dark:text-[#96EDF7]">
                            Weetje Ietta?
                        </h1>
                        <p className="mb-2 text-xl font-semibold text-[#042445]/90 dark:text-[#96EDF7]/90">
                            De Scheveningse Pubquiz
                        </p>
                        <p className="text-sm font-medium text-[#042445]/70 dark:text-[#96EDF7]/70">
                            onder leiding van Arie Spaans
                        </p>
                    </div>

                    {/* Info card with delay animation */}
                    <div className="mb-6 animate-in fade-in slide-in-from-top-4 rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-xl backdrop-blur-sm delay-150 duration-700 dark:border-[#032EFF]/30 dark:bg-[#042445]/90">
                        <div className="mb-5 flex items-center gap-3 transition-all hover:translate-x-1">
                            <div className="rounded-lg bg-[#96EDF7]/30 p-2 dark:bg-[#032EFF]/20">
                                <Calendar className="size-5 text-[#032EFF] dark:text-[#96EDF7]" />
                            </div>
                            <div>
                                <p className="text-sm font-semibold text-[#042445]/90 dark:text-[#96EDF7]/90">
                                    Zaterdag 13 december
                                </p>
                            </div>
                        </div>
                        <div className="mb-5 flex items-center gap-3 transition-all hover:translate-x-1">
                            <div className="rounded-lg bg-[#96EDF7]/30 p-2 dark:bg-[#032EFF]/20">
                                <Clock className="size-5 text-[#032EFF] dark:text-[#96EDF7]" />
                            </div>
                            <div>
                                <p className="text-sm font-semibold text-[#042445]/90 dark:text-[#96EDF7]/90">
                                    20:00 - 22:00 uur
                                </p>
                            </div>
                        </div>

                        {/* Progress bar section */}
                        <div className="space-y-3 border-t border-[#032EFF]/20 pt-5 dark:border-[#032EFF]/30">
                            <div className="flex items-center justify-between">
                                <div className="flex items-center gap-2">
                                    <Users className="size-5 text-[#032EFF] dark:text-[#96EDF7]" />
                                    <span className="text-sm font-medium text-[#042445]/90 dark:text-[#96EDF7]/90">
                                        Beschikbare plekken
                                    </span>
                                </div>
                                <span className="text-lg font-bold text-[#032EFF] dark:text-[#EDD100]">
                                    {remainingSpots} / {totalSpots}
                                </span>
                            </div>

                            {/* Animated progress bar */}
                            <div className="relative h-3 overflow-hidden rounded-full bg-[#96EDF7]/30 dark:bg-[#032EFF]/20">
                                <div
                                    className="h-full animate-in slide-in-from-left rounded-full bg-gradient-to-r from-[#032EFF] to-[#032EFF]/80 shadow-sm transition-all duration-1000 ease-out dark:from-[#EDD100] dark:to-[#EDD100]/80"
                                    style={{ width: `${fillPercentage}%` }}
                                />
                                <div className="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent" />
                            </div>

                            <p className="text-center text-xs text-[#042445]/70 dark:text-[#96EDF7]/70">
                                {filledSpots} van {totalSpots} plekken bezet
                            </p>
                        </div>
                    </div>

                    {flash?.success && (
                        <Alert className="mb-6 animate-in fade-in slide-in-from-top-2 border-green-200 bg-green-50 text-green-900 duration-500 dark:border-green-800 dark:bg-green-950 dark:text-green-100">
                            <CheckCircle2Icon className="text-green-600 dark:text-green-400" />
                            <AlertTitle>Gelukt!</AlertTitle>
                            <AlertDescription>{flash.success}</AlertDescription>
                        </Alert>
                    )}

                    {/* Form with delay animation */}
                    <div className="animate-in fade-in slide-in-from-bottom-4 rounded-xl border border-[#032EFF]/20 bg-white/90 p-6 shadow-2xl backdrop-blur-sm delay-300 duration-700 dark:border-[#032EFF]/30 dark:bg-[#042445]/90">
                        <Form action="/" method="post">
                            {({ errors, processing }) => (
                                <div className="flex flex-col gap-5">
                                    <div className="group flex flex-col gap-2">
                                        <Label htmlFor="name" className="font-semibold">Team naam</Label>
                                        <Input
                                            id="name"
                                            name="name"
                                            type="text"
                                            placeholder="De Slimme Vossen"
                                            required
                                            aria-invalid={errors.name ? 'true' : 'false'}
                                            className="transition-all duration-200 focus:scale-[1.02]"
                                        />
                                        {errors.name && (
                                            <p className="animate-in slide-in-from-top-1 text-sm font-medium text-red-600 duration-200 dark:text-red-400">
                                                {errors.name}
                                            </p>
                                        )}
                                    </div>

                                    <div className="group flex flex-col gap-2">
                                        <Label htmlFor="contact_name" className="font-semibold">Naam contactpersoon</Label>
                                        <Input
                                            id="contact_name"
                                            name="contact_name"
                                            type="text"
                                            placeholder="Jan Jansen"
                                            required
                                            aria-invalid={errors.contact_name ? 'true' : 'false'}
                                            className="transition-all duration-200 focus:scale-[1.02]"
                                        />
                                        {errors.contact_name && (
                                            <p className="animate-in slide-in-from-top-1 text-sm font-medium text-red-600 duration-200 dark:text-red-400">
                                                {errors.contact_name}
                                            </p>
                                        )}
                                    </div>

                                    <div className="group flex flex-col gap-2">
                                        <Label htmlFor="team_size" className="font-semibold">Aantal personen in team</Label>
                                        <Input
                                            id="team_size"
                                            name="team_size"
                                            type="number"
                                            min="1"
                                            max="8"
                                            placeholder="Bijv. 4"
                                            required
                                            aria-invalid={errors.team_size ? 'true' : 'false'}
                                            className="transition-all duration-200 focus:scale-[1.02]"
                                        />
                                        {errors.team_size && (
                                            <p className="animate-in slide-in-from-top-1 text-sm font-medium text-red-600 duration-200 dark:text-red-400">
                                                {errors.team_size}
                                            </p>
                                        )}
                                    </div>

                                    <div className="group flex flex-col gap-2">
                                        <Label htmlFor="email" className="font-semibold">E-mailadres</Label>
                                        <Input
                                            id="email"
                                            name="email"
                                            type="email"
                                            placeholder="team@voorbeeld.nl"
                                            required
                                            aria-invalid={errors.email ? 'true' : 'false'}
                                            className="transition-all duration-200 focus:scale-[1.02]"
                                        />
                                        {errors.email && (
                                            <p className="animate-in slide-in-from-top-1 text-sm font-medium text-red-600 duration-200 dark:text-red-400">
                                                {errors.email}
                                            </p>
                                        )}
                                    </div>

                                    <Button
                                        type="submit"
                                        disabled={processing || remainingSpots === 0}
                                        className="mt-3 h-12 w-full transform bg-gradient-to-r from-[#032EFF] to-[#032EFF]/90 text-base font-semibold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] hover:from-[#032EFF]/90 hover:to-[#032EFF]/80 hover:shadow-xl active:scale-95 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:scale-100 dark:from-[#EDD100] dark:to-[#EDD100]/90 dark:text-[#042445] dark:hover:from-[#EDD100]/90 dark:hover:to-[#EDD100]/80"
                                    >
                                        {processing ? (
                                            <span className="flex items-center gap-2">
                                                <svg className="size-5 animate-spin" viewBox="0 0 24 24">
                                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                                </svg>
                                                Aanmelden...
                                            </span>
                                        ) : (
                                            'Aanmelden voor Pubquiz'
                                        )}
                                    </Button>

                                    {remainingSpots === 0 && (
                                        <div className="animate-in fade-in rounded-lg bg-red-50 p-4 text-center duration-500 dark:bg-red-950">
                                            <p className="text-sm font-semibold text-red-600 dark:text-red-400">
                                                De pubquiz is helaas vol.
                                            </p>
                                        </div>
                                    )}
                                </div>
                            )}
                        </Form>
                    </div>

                    <p className="mt-6 animate-in fade-in text-center text-sm text-[#042445]/80 delay-500 duration-700 dark:text-[#96EDF7]/80">
                        Na aanmelding ontvang je een bevestiging per e-mail.
                    </p>
                </div>
            </div>
        </>
    );
}
