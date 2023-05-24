import { AppLayout } from "@/Layouts";
import { Head } from "@inertiajs/react";
import ProfileLayout from "./Partials/ProfileLayout";

export default function Notifications() {
    return (
        <AppLayout>
            <Head title="Notifications" />

            <ProfileLayout>Notifications</ProfileLayout>
        </AppLayout>
    );
}
