import { Logo, Logout, Sidebar } from "@/Components/General";
import { PageProps } from "@/types";
import { usePage } from "@inertiajs/react";
import { FC, ReactNode } from "react";
import Avatar from "./Avatar";
import clsx from "clsx";

interface Props {
    children: ReactNode;
}

const AppLayout: FC<Props> = (props) => {
    const { children } = props;

    const { data: auth } = usePage<PageProps>().props.auth;

    console.log("auth type", auth);

    return (
        <main className="flex min-h-screen bg-primary">
            <div
                className={clsx([
                    "w-[230px]",
                    "rounded-l-md",
                    "bg-white",
                    "border-r border-gray-200",
                    "pt-[30px] px-6",
                    "gap-6 flex flex-col",
                ])}
            >
                <Logo />

                <Sidebar />

                <div className="pl-[20px] flex-1 flex items-end pb-10">
                    <Logout />
                </div>
            </div>

            <div className="flex-1  pl-[80px]  flex gap-4 ">
                <div className="flex-1 pt-[30px]">
                    <section className="flex items-center">
                        <div>
                            <p className="text-xl font-bold ">
                                Welcome, {auth?.attributes?.name}
                            </p>
                            <p>{auth?.attributes?.email}</p>
                        </div>

                        <div className="flex justify-end flex-1">
                            <Avatar />
                        </div>
                    </section>

                    <section className="mt-8">{children}</section>
                </div>

                <div className="w-[200px] border-l bg-white"></div>
            </div>
        </main>
    );
};

export default AppLayout;
