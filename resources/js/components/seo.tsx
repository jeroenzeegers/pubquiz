import { Head } from '@inertiajs/react';

export interface SeoProps {
    title: string;
    description?: string;
    image?: string;
    url?: string;
    type?: 'website' | 'article' | 'event';
    siteName?: string;
    locale?: string;
    twitterCard?: 'summary' | 'summary_large_image';
}

export default function Seo({
    title,
    description,
    image,
    url,
    type = 'website',
    siteName = 'Weetje Ietta?',
    locale = 'nl_NL',
    twitterCard = 'summary_large_image',
}: SeoProps) {
    // Get the absolute URL from config or use current URL
    const absoluteUrl = url || (typeof window !== 'undefined' ? window.location.href : '');

    return (
        <Head>
            <title>{title}</title>
            {description && <meta name="description" content={description} />}

            {/* Canonical URL */}
            {absoluteUrl && <link rel="canonical" href={absoluteUrl} />}

            {/* Open Graph Tags */}
            <meta property="og:title" content={title} />
            {description && <meta property="og:description" content={description} />}
            <meta property="og:type" content={type} />
            {absoluteUrl && <meta property="og:url" content={absoluteUrl} />}
            {image && <meta property="og:image" content={image} />}
            <meta property="og:site_name" content={siteName} />
            <meta property="og:locale" content={locale} />

            {/* Twitter Card Tags */}
            <meta name="twitter:card" content={twitterCard} />
            <meta name="twitter:title" content={title} />
            {description && <meta name="twitter:description" content={description} />}
            {image && <meta name="twitter:image" content={image} />}
        </Head>
    );
}
