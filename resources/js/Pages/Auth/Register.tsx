import { AuthLayout } from "@/Layouts";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import { PageProps, RoleName } from "@/types";
import { Alert } from "@/Components/General";
import { FormButton, FormInput, FormPhoneInput } from "@/Components/FormUI";
import { TfiUser, TfiEmail, TfiLock } from "react-icons/tfi";
import { FormEventHandler } from "react";

// type Role = "super-admin" | "vendor" | "customer" | "vendor-admin";

type FormValues = {
    email: string;
    password: string;
    phone?: string;
    name?: string;
    role?: RoleName | "";
};

export default function Register() {
    const formValues: FormValues = {
        email: "",
        password: "",
        phone: "",
        name: "",
        role: "super-admin",
    };

    const { data, processing, post, errors, setData } = useForm(formValues);

    const { success, error } = usePage<PageProps>().props;

    const onSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        // console.log("data", data);
        post(route("action.register"));
    };

    return (
        <AuthLayout>
            <Head title="Register" />

            <form onSubmit={onSubmit} className="space-y-4">
                <div className="font-interBold text-xl w-[300px] ">
                    <p>Create account</p>
                    <p className="font-inter text-base ">
                        Create your account to continue with Mobidder
                    </p>
                </div>

                {error && <Alert message={error} type="error" />}

                {success && <Alert message={success} type="success" />}

                <FormInput
                    name="email"
                    instructions="Email address *"
                    placeholder="Enter email address"
                    icon={TfiEmail}
                    value={data.email}
                    error={errors.email}
                    onChange={(e) => {
                        setData("email", e.target.value);
                    }}
                    helperText="Your email shall work as part pfr your credentials"
                />

                <FormInput
                    name="name"
                    instructions="Name *"
                    placeholder="Enter your name"
                    icon={TfiUser}
                    value={data.name}
                    error={errors.name}
                    onChange={(e) => {
                        setData("name", e.target.value);
                    }}
                />

                <FormInput
                    name="password"
                    instructions="Password *"
                    placeholder="Enter password"
                    type="password"
                    icon={TfiLock}
                    value={data.password}
                    error={errors.password}
                    onChange={(e) => {
                        setData("password", e.target.value);
                    }}
                />

                <FormPhoneInput
                    name="phone"
                    instructions="Mobile number *"
                    placeholder="Enter mobile number"
                    value={data.phone}
                    error={errors.phone}
                    onChange={(value: string) => {
                        setData("phone", value);
                    }}
                />

                <FormButton
                    label="Sign Up"
                    htmlType="submit"
                    processing={processing}
                />

                <div className="flex flex-col gap-0">
                    <p>Already have an account?</p>
                    <Link
                        href={route("ui.login")}
                        className="text-blue-900 text-sm"
                    >
                        Sign in here
                    </Link>
                </div>
            </form>
        </AuthLayout>
    );
}
