import { FormEventHandler } from "react";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import { FormButton, FormInput } from "@/Components/FormUI";
import { IoKeypadOutline, IoMailOutline } from "react-icons/io5";
import { PageProps } from "@/types";
import { Alert } from "@/Components/General";
import { AuthLayout } from "@/Layouts";

type FormValues = {
    email: string;
    password: string;
};

export default function Login() {
    const formValues: FormValues = {
        email: "",
        password: "",
    };

    const { processing, post, errors, data, setData } = useForm(formValues);

    const { success, error } = usePage<PageProps>().props;

    const onSubmit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route("action.login"));
    };

    return (
        <AuthLayout>
            <Head title="Log in" />

            <form className="space-y-4" onSubmit={onSubmit}>
                <div className="font-interBold text-xl ">
                    <p>Hey,</p>
                    <p>Welcome back</p>
                    <p className="font-inter text-base ">
                        Enter your correct credentials to login
                    </p>
                </div>

                {error && <Alert message={error} type="error" />}

                {success && <Alert message={success} type="success" />}

                <FormInput
                    name="email"
                    instructions="Email address *"
                    placeholder="Enter email address"
                    icon={IoMailOutline}
                    value={data.email}
                    error={errors.email}
                    onChange={(e) => {
                        setData("email", e.target.value);
                    }}
                />

                <FormInput
                    name="password"
                    instructions="Password *"
                    placeholder="Enter password"
                    type="password"
                    icon={IoKeypadOutline}
                    value={data.password}
                    error={errors.password}
                    onChange={(e) => {
                        setData("password", e.target.value);
                    }}
                />

                <FormButton
                    label="Sign In"
                    htmlType="submit"
                    processing={processing}
                />

                <div className="flex flex-col gap-0">
                    <p>Don't have an account?</p>
                    <Link
                        href={route("ui.register")}
                        className="text-blue-900 text-sm "
                    >
                        Sign up here
                    </Link>
                </div>
            </form>
        </AuthLayout>
    );
}
