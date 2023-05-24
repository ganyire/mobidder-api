import { InertiaLinkProps, Link } from "@inertiajs/react";
import { FC } from "react";
import { IconType } from "react-icons";

interface Props extends InertiaLinkProps {
    href: string;
    label: string;
    active: boolean;
    icon?: IconType;
}

const AppLink: FC<Props> = (props) => {
    const { href, label, active, icon: Icon } = props;

    return (
        <Link
            href={href}
            className={`px-4 py-2 w-full rounded-lg flex items-center gap-2 ${
                active ? "bg-accent text-white" : " text-slate-700 "
            }`}
        >
            {Icon && <Icon size={25} />}
            {label}
        </Link>
    );
};

export default AppLink;
