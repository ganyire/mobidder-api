import { FormButton, FormInput } from "@/Components/FormUI";
import { useForm } from "@inertiajs/react";
import React, { FormEventHandler } from "react";
import { TfiLock } from "react-icons/tfi";

type FormValues = {
    oldPassword: string;
    password: string;
    password_confirmation: string;
};

const ChangePassword = () => {
    const formValues: FormValues = {
        oldPassword: "",
        password: "",
        password_confirmation: "",
    };

    const { data, processing, post, errors, setData } = useForm(formValues);

    const onSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        data.password_confirmation = data.password;
        post(route("action.change-password"));
    };

    return (
        <form onSubmit={onSubmit} className="space-y-3 w-[400px]">
            <div className="space-y-1 mb-2 pb-2">
                <p>Change password</p>
                <p className="text-xs">
                    Enter your old/current password and the new password that
                    you want to change it to
                </p>
            </div>

            <FormInput
                name="oldPassword"
                instructions="Old password"
                placeholder="Enter old password*"
                type="password"
                width={400}
                icon={TfiLock}
                value={data.oldPassword}
                error={errors.oldPassword}
                onChange={(e) => {
                    setData("oldPassword", e.target.value);
                }}
            />

            <FormInput
                name="password"
                instructions="New password"
                placeholder="Enter new password*"
                type="password"
                width={400}
                icon={TfiLock}
                value={data.password}
                error={errors.password}
                helperText={
                    <ul className=" list-disc list-inside ">
                        <li>At least 6 characters long</li>
                        <li>Include both numbers and alphabet characters</li>
                    </ul>
                }
                onChange={(e) => {
                    setData("password", e.target.value);
                }}
            />

            <FormButton
                label="Update password"
                htmlType="submit"
                width={200}
                processing={processing}
            />
        </form>
    );
};

export default ChangePassword;
