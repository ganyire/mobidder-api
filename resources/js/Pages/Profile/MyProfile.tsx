import { FormButton, FormInput, FormPhoneInput } from "@/Components/FormUI";
import { Alert } from "@/Components/General";
import { AppLayout } from "@/Layouts";
import { PageProps } from "@/types";
import { Head, useForm, usePage } from "@inertiajs/react";
import { FormEventHandler } from "react";
import { TfiUser } from "react-icons/tfi";
import { ProfileHeading, ProfileLayout } from "./Partials";

type FormValues = {
    phone?: string;
    name?: string;
};

export default function MyProfile() {
    const { success, error, auth } = usePage<PageProps>().props;

    const formValues: FormValues = {
        phone: auth?.attributes?.phone || "",
        name: auth?.attributes?.name || "",
    };
    const { data, processing, post, errors, setData } = useForm(formValues);

    const onSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("action.profile"));
    };

    return (
        <AppLayout>
            <Head title="My profile" />

            <ProfileLayout>
                <ProfileHeading>Profile</ProfileHeading>

                {(success || error) && (
                    <div className="w-[400px] mb-2">
                        <Alert
                            message={success || error}
                            type={error ? "error" : "success"}
                        />
                    </div>
                )}

                <form onSubmit={onSubmit} className="space-y-3 w-[400px]">
                    <FormInput
                        name="name"
                        instructions="Full name *"
                        placeholder="Enter full name"
                        icon={TfiUser}
                        value={data.name}
                        error={errors.name}
                        width={400}
                        onChange={(e) => {
                            setData("name", e.target.value);
                        }}
                        helperText="Your full name is used to identify you on the platform e.g John Doe"
                    />

                    <FormPhoneInput
                        name="phone"
                        instructions="Mobile number *"
                        placeholder="Enter mobile number"
                        value={data.phone}
                        error={errors.phone}
                        width={400}
                        onChange={(value: string) => {
                            setData("phone", value);
                        }}
                        helperText="Use international format for your phone number
                            including the (+) e.g +263780570000"
                    />

                    <FormButton
                        label="Update profile"
                        htmlType="submit"
                        width={200}
                        processing={processing}
                    />
                </form>
            </ProfileLayout>
        </AppLayout>
    );
}
