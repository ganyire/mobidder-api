import { Link } from "@inertiajs/react";
import { AiOutlineLogout } from "react-icons/ai";
import clsx from "clsx";

const Logout = () => {
    return (
        <Link
            href={route("action.logout")}
            as="button"
            method="post"
            className={clsx([
                "flex justify-center items-center",
                "p-2",
                "bg-gradient-to-t from-white to-gray-200 hover:from-gray-200 hover:to-white ",
                "shadow-sm shadow-slate-800",
                "rounded-xl",
            ])}
        >
            <AiOutlineLogout className="text-gray-500 text-[30px] " />
            Logout
        </Link>
    );
};

export default Logout;
