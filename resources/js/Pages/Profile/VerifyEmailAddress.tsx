import { FormButton, FormInput } from "@/Components/FormUI";
import { Alert } from "@/Components/General";
import { AppLayout } from "@/Layouts";
import { PageProps } from "@/types";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import { Button } from "antd";
import clsx from "clsx";
import { FormEventHandler, useState } from "react";
import { AiOutlineNumber } from "react-icons/ai";
import { ProfileHeading, ProfileLayout } from "./Partials";

type FormValues = {
    email_verification_token: string;
};

export default function VerifyEmailAddress() {
    const [showVerificationCodeForm, setShowVerificationCodeForm] =
        useState<boolean>(false);

    const { error, success, auth } = usePage<PageProps>().props;

    const sendEmailVerificationCode = () => {
        post(route("action.send-email-verification-code"));
        setShowVerificationCodeForm(true);
    };

    const formValues: FormValues = {
        email_verification_token: "",
    };

    const { data, processing, post, errors, setData } = useForm(formValues);

    const onSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("action.verify-email-address"));
        // setShowVerificationCodeForm(false);
    };

    return (
        <AppLayout>
            <Head title="Verify email" />

            <ProfileLayout>
                <ProfileHeading>Email settings</ProfileHeading>

                {(success || error) && (
                    <div className="w-[500px] mb-2">
                        <Alert
                            message={success || error}
                            type={error ? "error" : "success"}
                        />
                    </div>
                )}

                <div className="space-y-2">
                    <p>
                        Click the button below to receive a verification code in
                        your current email which is{" "}
                        <span className="font-bold">
                            ({auth?.attributes?.email})
                        </span>
                        <br /> Use the verification code to verify your email.
                    </p>

                    <Button
                        onClick={sendEmailVerificationCode}
                        htmlType="button"
                    >
                        Sent verification code
                    </Button>
                </div>

                {showVerificationCodeForm && (
                    <form onSubmit={onSubmit} className="mt-6 space-y-2">
                        <p>
                            A verification code has been sent to your email
                            address. Please enter it here to continue
                        </p>

                        <div className="flex gap-2 items-start">
                            <FormInput
                                name="email_verification_token"
                                instructions="Verification code *"
                                placeholder="Enter verification code"
                                icon={AiOutlineNumber}
                                value={data.email_verification_token}
                                error={errors.email_verification_token}
                                width={400}
                                onChange={(e) => {
                                    setData(
                                        "email_verification_token",
                                        e.target.value
                                    );
                                }}
                                helperText="The verification code will expire in 5 minutes"
                            />

                            <FormButton
                                label="Verify email"
                                htmlType="submit"
                                width={200}
                                processing={processing}
                            />
                        </div>

                        <Link
                            href={route("action.send-email-verification-code")}
                            as="button"
                            method="post"
                            className="text-accent text-sm ml-2"
                        >
                            Re-send verification code
                        </Link>
                    </form>
                )}
            </ProfileLayout>
        </AppLayout>
    );
}
