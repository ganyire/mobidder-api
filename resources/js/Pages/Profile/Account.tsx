import { Alert } from "@/Components/General";
import { AppLayout } from "@/Layouts";
import { PageProps } from "@/types";
import { Head, usePage } from "@inertiajs/react";
import {
    ChangeEmailAddress,
    ChangePassword,
    ProfileHeading,
    ProfileLayout,
} from "./Partials";

export default function Account() {
    const { success, error } = usePage<PageProps>().props;

    return (
        <AppLayout>
            <Head title="Account" />

            <ProfileLayout>
                <ProfileHeading>Account</ProfileHeading>

                {(success || error) && (
                    <div className="w-[400px] mb-2">
                        <Alert
                            message={success || error}
                            type={error ? "error" : "success"}
                        />
                    </div>
                )}

                <div className="space-y-8 mt-4">
                    <ChangePassword />

                    <ChangeEmailAddress />
                </div>
            </ProfileLayout>
        </AppLayout>
    );
}
