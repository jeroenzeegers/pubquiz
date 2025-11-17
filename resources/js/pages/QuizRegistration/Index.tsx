import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, usePage } from '@inertiajs/react';
import { Form } from '@inertiajs/react';
import { Calendar, CheckCircle2Icon, Clock, Sparkles, Users } from 'lucide-react';

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
            <div className="flex min-h-screen flex-col items-center justify-center bg-gradient-to-br from-amber-50 via-orange-50 to-orange-100 p-6 dark:from-neutral-950 dark:via-neutral-900 dark:to-neutral-800">
                <div className="w-full max-w-md">
                    {/* Header with staggered animation */}
                    <div className="mb-8 animate-in fade-in slide-in-from-top-4 text-center duration-700">
                        <div className="mb-4 inline-flex rounded-full bg-orange-100 p-3 dark:bg-orange-950">
                            <Sparkles className="size-8 text-orange-600 dark:text-orange-400" />
                        </div>
                        <h1 className="mb-3 text-5xl font-bold tracking-tight text-orange-900 dark:text-orange-100">
                            Weetje Ietta?
                        </h1>
                        <p className="mb-2 text-xl font-semibold text-orange-800 dark:text-orange-200">
                            De Scheveningse Pubquiz
                        </p>
                        <p className="text-sm font-medium text-orange-700 dark:text-orange-300">
                            onder leiding van Arie Spaans
                        </p>
                    </div>

                    {/* Info card with delay animation */}
                    <div className="mb-6 animate-in fade-in slide-in-from-top-4 rounded-xl border border-orange-200 bg-white/80 p-6 shadow-xl backdrop-blur-sm delay-150 duration-700 dark:border-orange-800 dark:bg-neutral-900/80">
                        <div className="mb-5 flex items-center gap-3 transition-all hover:translate-x-1">
                            <div className="rounded-lg bg-orange-100 p-2 dark:bg-orange-950">
                                <Calendar className="size-5 text-orange-600 dark:text-orange-400" />
                            </div>
                            <div>
                                <p className="text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    Zaterdag 13 december
                                </p>
                            </div>
                        </div>
                        <div className="mb-5 flex items-center gap-3 transition-all hover:translate-x-1">
                            <div className="rounded-lg bg-orange-100 p-2 dark:bg-orange-950">
                                <Clock className="size-5 text-orange-600 dark:text-orange-400" />
                            </div>
                            <div>
                                <p className="text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    20:00 - 22:00 uur
                                </p>
                            </div>
                        </div>

                        {/* Progress bar section */}
                        <div className="space-y-3 border-t border-orange-200 pt-5 dark:border-orange-800">
                            <div className="flex items-center justify-between">
                                <div className="flex items-center gap-2">
                                    <Users className="size-5 text-orange-600 dark:text-orange-400" />
                                    <span className="text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                        Beschikbare plekken
                                    </span>
                                </div>
                                <span className="text-lg font-bold text-orange-600 dark:text-orange-400">
                                    {remainingSpots} / {totalSpots}
                                </span>
                            </div>

                            {/* Animated progress bar */}
                            <div className="relative h-3 overflow-hidden rounded-full bg-orange-100 dark:bg-orange-950">
                                <div
                                    className="h-full animate-in slide-in-from-left rounded-full bg-gradient-to-r from-orange-500 to-orange-600 shadow-sm transition-all duration-1000 ease-out dark:from-orange-600 dark:to-orange-700"
                                    style={{ width: `${fillPercentage}%` }}
                                />
                                <div className="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent" />
                            </div>

                            <p className="text-center text-xs text-neutral-600 dark:text-neutral-400">
                                {filledSpots} van {totalSpots} plekken bezet
                            </p>
                        </div>
                    </div>

                    {flash?.success && (
                        <Alert className="mb-6 border-green-200 bg-green-50 text-green-900 dark:border-green-800 dark:bg-green-950 dark:text-green-100">
                            <CheckCircle2Icon className="text-green-600 dark:text-green-400" />
                            <AlertTitle>Gelukt!</AlertTitle>
                            <AlertDescription>{flash.success}</AlertDescription>
                        </Alert>
                    )}

                    <div className="rounded-lg border border-orange-200 bg-white p-6 shadow-lg dark:border-orange-800 dark:bg-neutral-900">
                        <Form action="/" method="post">
                            {({ errors, processing }) => (
                                <div className="flex flex-col gap-4">
                                    <div className="flex flex-col gap-2">
                                        <Label htmlFor="name">Naam</Label>
                                        <Input
                                            id="name"
                                            name="name"
                                            type="text"
                                            placeholder="Team naam"
                                            required
                                            aria-invalid={errors.name ? 'true' : 'false'}
                                        />
                                        {errors.name && (
                                            <p className="text-sm text-red-600 dark:text-red-400">
                                                {errors.name}
                                            </p>
                                        )}
                                    </div>

                                    <div className="flex flex-col gap-2">
                                        <Label htmlFor="team_size">Aantal personen in team</Label>
                                        <Input
                                            id="team_size"
                                            name="team_size"
                                            type="number"
                                            min="1"
                                            max="8"
                                            placeholder="Bijv. 4"
                                            required
                                            aria-invalid={errors.team_size ? 'true' : 'false'}
                                        />
                                        {errors.team_size && (
                                            <p className="text-sm text-red-600 dark:text-red-400">
                                                {errors.team_size}
                                            </p>
                                        )}
                                    </div>

                                    <div className="flex flex-col gap-2">
                                        <Label htmlFor="email">E-mailadres</Label>
                                        <Input
                                            id="email"
                                            name="email"
                                            type="email"
                                            placeholder="team@voorbeeld.nl"
                                            required
                                            aria-invalid={errors.email ? 'true' : 'false'}
                                        />
                                        {errors.email && (
                                            <p className="text-sm text-red-600 dark:text-red-400">
                                                {errors.email}
                                            </p>
                                        )}
                                    </div>

                                    <Button
                                        type="submit"
                                        disabled={processing || remainingSpots === 0}
                                        className="mt-2 w-full"
                                    >
                                        {processing ? 'Aanmelden...' : 'Aanmelden'}
                                    </Button>

                                    {remainingSpots === 0 && (
                                        <p className="text-center text-sm text-red-600 dark:text-red-400">
                                            De pubquiz is helaas vol.
                                        </p>
                                    )}
                                </div>
                            )}
                        </Form>
                    </div>

                    <p className="mt-6 text-center text-sm text-orange-800 dark:text-orange-200">
                        Na aanmelding ontvang je een bevestiging per e-mail.
                    </p>
                </div>
            </div>
        </>
    );
}
