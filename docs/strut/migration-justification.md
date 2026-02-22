# CMS Migration — Client Justification

## Why the migration was necessary

- The old CMS was built 6+ years ago on Vue 2 and Laravel 11
- Vue 2 reached end-of-life — no more security patches or updates
- Staying on a dead stack means increasing maintenance costs over time
- Fewer developers support legacy stacks, making future work more expensive
- Risk of unpatched security vulnerabilities growing with every month

## What was done

- Full CMS migration to Vue 3 + Laravel with modern stack
- All domain modules migrated: Awards, Books, Content, Jobs, Lectures, News, Press, Team
- Production data imported and verified
- Admin interface fully functional
- ~10h tracked in git commits, ~20-24h total (planning, research, testing, debugging, data migration)

## How to communicate it

Keep it simple, non-technical:

> "The CMS was built on technology that is no longer supported. We've updated it to a modern, secure stack to ensure long-term maintainability. The admin area is fully migrated — the frontend update is the next step."

## Billing advice

- **Bundle with frontend work** — don't send a separate "migration" invoice. Deliver the updated frontend and bill "CMS and website update" as one package. The client gets something visible for their money.
- **Spread it** — if on a maintenance contract, absorb some hours across a few months.
- **Be transparent but brief** — no need to over-explain or apologize. Tech maintenance is a normal cost.

## Perspective

- 3000 CHF for a system used 6+ years (and counting) = less than 500 CHF/year
- Any web agency would charge 3-5x for the same migration scope
- NOT migrating would mean higher costs for every future change, plus the risk of an emergency migration down the line
