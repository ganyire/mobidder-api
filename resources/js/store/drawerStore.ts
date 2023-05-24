import { create } from "zustand";

interface DrawerState {
    profileDrawerIsOpen: boolean;
    openProfileDrawer: () => void;
    closeProfileDrawer: () => void;
}

const useDrawerStore = create<DrawerState>()((set) => ({
    profileDrawerIsOpen: false,
    openProfileDrawer: () => set({ profileDrawerIsOpen: true }),
    closeProfileDrawer: () => set({ profileDrawerIsOpen: false }),
}));

export default useDrawerStore;
