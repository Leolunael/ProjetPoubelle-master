import { useState } from "react";
import { Link } from "react-router-dom";
import { Dialog, DialogPanel } from "@headlessui/react";
import { Bars3Icon, XMarkIcon } from "@heroicons/react/24/outline";

const navigation = [
  { name: "Signaler", href: "/signaler" },
  { name: "Calendrier", href: "/calendrier" },
  { name: "Recyclage", href: "/recyclage" },
  { name: "Renseigner", href: "/renseigner" },
  { name: "Enfant", href: "/enfant" },
];

export default function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  return (
    <header className="bg-white">
      <nav
        aria-label="Navigation principale"
        className="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8"
      >
        {/* Logo */}
        <div className="flex lg:flex-1">
          <Link to="/" className="-m-1.5 p-1.5">
            <span className="sr-only">Accueil</span>
            <img alt="Logo" src="/src/assets/logo.svg" className="h-8 w-auto" />
          </Link>
        </div>

        {/* Navigation desktop */}
        <div className="hidden lg:flex lg:gap-x-12">
          {navigation.map((item) => (
            <Link
              key={item.name}
              to={item.href}
              className="text-sm/6 font-semibold text-gray-900 transition-colors hover:text-green-600"
            >
              {item.name}
            </Link>
          ))}
        </div>

        <div className="flex flex-1 items-center justify-end gap-x-6">
          <Link
            to="/login"
            className="hidden text-sm/6 font-semibold text-gray-900 transition-colors hover:text-green-600 lg:block"
          >
            Connexion
          </Link>
          <Link
            to="/register"
            className="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs transition-colors hover:bg-green-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Inscription
          </Link>
        </div>

        {/* Bouton menu mobile */}
        <div className="flex lg:hidden">
          <button
            type="button"
            onClick={() => setMobileMenuOpen(true)}
            className="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
            aria-expanded={mobileMenuOpen}
          >
            <span className="sr-only">Ouvrir le menu principal</span>
            <Bars3Icon aria-hidden="true" className="size-6" />
          </button>
        </div>
      </nav>

      {/* Menu mobile */}
      <Dialog
        open={mobileMenuOpen}
        onClose={setMobileMenuOpen}
        className="lg:hidden"
      >
        <div className="fixed inset-0 z-50 bg-black/20" aria-hidden="true" />
        <DialogPanel className="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div className="flex items-center gap-x-6">
            <Link
              to="/"
              className="-m-1.5 p-1.5"
              onClick={() => setMobileMenuOpen(false)}
            >
              <span className="sr-only">Accueil</span>
              <img
                alt="Logo"
                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                className="h-8 w-auto"
              />
            </Link>
            <Link
              to="/register"
              className="ml-auto rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-xs transition-colors hover:bg-green-700"
              onClick={() => setMobileMenuOpen(false)}
            >
              Inscription
            </Link>
            <button
              type="button"
              onClick={() => setMobileMenuOpen(false)}
              className="-m-2.5 rounded-md p-2.5 text-gray-700"
            >
              <span className="sr-only">Fermer le menu</span>
              <XMarkIcon aria-hidden="true" className="size-6" />
            </button>
          </div>
          <div className="mt-6 flow-root">
            <div className="-my-6 divide-y divide-gray-500/10">
              <div className="space-y-2 py-6">
                {navigation.map((item) => (
                  <Link
                    key={item.name}
                    to={item.href}
                    className="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 transition-colors hover:bg-gray-50"
                    onClick={() => setMobileMenuOpen(false)}
                  >
                    {item.name}
                  </Link>
                ))}
              </div>
              <div className="py-6">
                <Link
                  to="/login"
                  className="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 transition-colors hover:bg-gray-50"
                  onClick={() => setMobileMenuOpen(false)}
                >
                  Connexion
                </Link>
              </div>
            </div>
          </div>
        </DialogPanel>
      </Dialog>
    </header>
  );
}
