export default function Login() {
  return (
    <div className="flex min-h-screen w-full justify-center bg-gray-200 pt-32">
      <div className="flex w-md flex-col gap-6 p-6">
        <h1 className="mb-2 w-full text-center text-base font-semibold sm:text-2xl">
          Connectez-vous à votre compte
        </h1>

        <div className="flex w-full flex-col gap-2">
          <label htmlFor="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="votre@adressemail.com"
            className="rounded-md bg-gray-100 px-3 py-1.5 outline-1 outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:outline-offset-2 focus:outline-green-500 sm:text-sm/6"
          />
        </div>

        <div className="flex w-full flex-col gap-2">
          <label htmlFor="password">Mot de passe</label>
          <input
            type="password"
            id="password"
            name="password"
            className="rounded-md bg-gray-100 px-3 py-1.5 outline-1 outline-offset-1 outline-white/10 focus:outline-2 focus:outline-offset-2 focus:outline-green-500 sm:text-sm/6"
          />
        </div>

        <div className="flex w-full flex-row items-center justify-between">
          <div className="flex flex-row items-center gap-2.5">
            <div className="flex h-6 shrink-0 items-center">
              <div className="group grid size-4">
                <input
                  id="remember"
                  type="checkbox"
                  name="remember"
                  defaultChecked
                  aria-describedby="remember-description"
                  className="col-start-1 row-start-1 cursor-pointer appearance-none rounded-sm border border-white/10 bg-gray-100 outline-1 outline-offset-1 outline-gray-300 checked:border-green-500 checked:bg-green-500 indeterminate:border-green-500 indeterminate:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 disabled:border-white/5 disabled:bg-white/10 disabled:checked:bg-white/10 forced-colors:appearance-auto"
                />
                <svg
                  viewBox="0 0 14 14"
                  fill="none"
                  className="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-white/25"
                >
                  <path
                    d="M3 8L6 11L11 3.5"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="opacity-0 group-has-checked:opacity-100"
                  />
                  <path
                    d="M3 7H11"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="opacity-0 group-has-indeterminate:opacity-100"
                  />
                </svg>
              </div>
            </div>
            <label htmlFor="remember" className="text-sm sm:text-base">
              Se souvenir de moi
            </label>
          </div>
          <p className="cursor-pointer text-xs underline sm:text-base">
            Mot de passe oublié ?
          </p>
        </div>

        <button
          type="button"
          className="w-full cursor-pointer rounded-md bg-green-600 py-2 font-semibold text-white"
        >
          Connexion
        </button>

        <p className="w-full text-center text-sm font-medium sm:text-base">
          Vous n&apos;avez pas de compte ?
          <span className="cursor-pointer text-green-700">Inscription</span>
        </p>
      </div>
    </div>
  );
}
