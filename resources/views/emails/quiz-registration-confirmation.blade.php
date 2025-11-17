<x-mail::message>
# Bevestiging Pubquiz Aanmelding

Beste {{ $registration->name }},

Bedankt voor je aanmelding voor **"Weetje Ietta?" - De Scheveningse Pubquiz**! We hebben je inschrijving succesvol ontvangen.

## Quiz Details
- **Datum:** Zaterdag 13 december
- **Tijd:** 20:00 - 22:00 uur
- **Quizmaster:** Arie Spaans

## Je Aanmelding
- **Team naam:** {{ $registration->name }}
- **Aantal personen:** {{ $registration->team_size }}
- **E-mailadres:** {{ $registration->email }}

We kijken ernaar uit om jullie te zien bij de pubquiz!

Met vriendelijke groet,<br>
Het Pubquiz Team
</x-mail::message>
