import { PageProps } from "@/types";
import { Link, usePage } from "@inertiajs/react";
import { FC, ReactNode } from "react";
import { IconType } from "react-icons";
import {
    AiOutlineBell,
    AiOutlineMail,
    AiOutlineSetting,
    AiOutlineUser,
} from "react-icons/ai";

function ProfileLink(props: {
    href: string;
    active: boolean;
    label: string;
    icon: IconType;
}) {
    const { href, active, label, icon: Icon } = props;

    return (
        <Link
            href={href}
            className={`flex items-center gap-2 px-2 py-2 rounded-r text-sm ${
                active
                    ? "font-bold border-l-4 border-accent bg-gray-200"
                    : "border-l-4 border-transparent text-accent"
            }`}
        >
            {<Icon size={20} />} {label}
        </Link>
    );
}

interface Props {
    children: ReactNode;
}

const ProfileLayout: FC<Props> = (props) => {
    const { children } = props;

    const { auth } = usePage<PageProps>().props;

    return (
        <div className="flex gap-[50px]">
            <div className="w-[250px] text-slate-700 ">
                <ProfileLink
                    href={route("ui.profile")}
                    active={route().current("ui.profile")}
                    label="Profile"
                    icon={AiOutlineUser}
                />

                <ProfileLink
                    href={route("ui.profile.account")}
                    active={route().current("ui.profile.account")}
                    label="Account"
                    icon={AiOutlineSetting}
                />

                {!!auth?.attributes?.emailIsVerified && (
                    <ProfileLink
                        href={route("ui.profile.verify-email")}
                        active={route().current("ui.profile.verify-email")}
                        label="Email settings"
                        icon={AiOutlineMail}
                    />
                )}

                <ProfileLink
                    href={route("ui.profile.notifications")}
                    active={route().current("ui.profile.notifications")}
                    label="Notifications"
                    icon={AiOutlineBell}
                />
            </div>

            <div className="flex-1">{children}</div>
        </div>
    );
};

export default ProfileLayout;
