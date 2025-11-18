import { Head } from '@inertiajs/react';

export interface StructuredDataProps {
    data: Record<string, any>;
}

export default function StructuredData({ data }: StructuredDataProps) {
    return (
        <Head>
            <script
                type="application/ld+json"
                dangerouslySetInnerHTML={{
                    __html: JSON.stringify(data),
                }}
            />
        </Head>
    );
}
