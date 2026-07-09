# InnChat Studio host routing moved (2026-07-08)

Studio frontend hostnames (e.g. `<tenant>.innchat.co`, `innchat.glw.com.co`)
are NO longer routed by the per-tenant ingresses in this directory. They all
route to the single multi-tenant frontend via the merged ingress:

    InnChatStudio repo -> k8s/frontend-ingress.yaml
    (Ingress `innchat-studio-frontend`, ns `inncrea`, ALB group prod-alpha-07)

The per-tenant ingress files here keep only their InnChat (Chatwoot-based)
chat hosts and marketing sites. Do NOT re-add `innchat-studio-frontend-*`
service rules to these files — those per-tenant Services no longer exist, so
a duplicate host rule would black-hole the tenant's Studio URL.

Onboarding a new tenant's Studio URL = add its host to the merged ingress in
the InnChatStudio repo + DNS. See the `tenant-onboarding` skill.
