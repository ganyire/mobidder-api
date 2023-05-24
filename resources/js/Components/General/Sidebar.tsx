import { CiBadgeDollar, CiBoxList, CiGrid41, CiUser } from "react-icons/ci";
import AppLink from "./AppLink";

const Sidebar = () => {
    return (
        <div className="flex flex-col gap-0">
            <AppLink
                href={route("dashboard.admin")}
                active={route().current("dashboard.admin")}
                label="Dashboard"
                icon={CiGrid41}
            />

            <AppLink
                href={route("ui.users")}
                active={route().current("ui.users")}
                icon={CiUser}
                label="Users"
            />

            <AppLink
                href={route("ui.users")}
                active={route().current("ui.users")}
                icon={CiBoxList}
                label="Statistics"
            />

            <AppLink
                href={route("ui.users")}
                active={route().current("ui.users")}
                icon={CiBadgeDollar}
                label="Finance"
            />
        </div>
    );
};

export default Sidebar;
