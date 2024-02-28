import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/primary_button.dart';

class IncomeSourcesTab extends HookWidget {
  const IncomeSourcesTab({Key? key, this.onComplete}) : super(key: key);

  final Function()? onComplete;
  @override
  Widget build(BuildContext context) {
    final isSalaryFilled = useState(false);
    final isInterestsFilled = useState(false);
    final isInterestsOnSecurityFilled = useState(false);
    final isRentNPropertyFilled = useState(false);

    return Column(
      children: [
        ListTile(
          leading: Image.asset(
            'assets/icons/salary.png',
            width: 24,
          ),
          minLeadingWidth: 24,
          title: Text(AppLocalizations.of(context)!.salary),
          tileColor: Theme.of(context).colorScheme.secondary,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
            side: BorderSide(
              width: 0.5,
              color: Theme.of(context).colorScheme.primary.withOpacity(0.25),
            ),
          ),
          trailing: isSalaryFilled.value == true
              ? const Icon(
                  Icons.done,
                  color: Colors.green,
                )
              : null,
          onTap: () async {
            final result = await Navigator.pushNamed(
              context,
              Routes.salaryInfo,
            ) as bool?;
            if (result == true) {
              isSalaryFilled.value = true;
            }
          },
        ),
        const SizedBox(height: 12),
        ListTile(
          leading: Image.asset(
            'assets/icons/interests.png',
            width: 24,
          ),
          minLeadingWidth: 24,
          title: Text(AppLocalizations.of(context)!.interests),
          tileColor: Theme.of(context).colorScheme.secondary,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
            side: BorderSide(
              width: 0.5,
              color: Theme.of(context).colorScheme.primary.withOpacity(0.25),
            ),
          ),
          trailing: isInterestsFilled.value == true
              ? const Icon(
                  Icons.done,
                  color: Colors.green,
                )
              : null,
          onTap: () async {
            final result = await Navigator.pushNamed(
              context,
              Routes.interests,
            ) as bool?;
            if (result == true) {
              isInterestsFilled.value = true;
            }
          },
        ),
        const SizedBox(height: 12),
        ListTile(
          leading: Image.asset(
            'assets/icons/money-bag.png',
            width: 24,
          ),
          minLeadingWidth: 24,
          title: Text(AppLocalizations.of(context)!.interests_on_security),
          tileColor: Theme.of(context).colorScheme.secondary,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
            side: BorderSide(
              width: 0.5,
              color: Theme.of(context).colorScheme.primary.withOpacity(0.25),
            ),
          ),
          trailing: isInterestsOnSecurityFilled.value == true
              ? const Icon(
                  Icons.done,
                  color: Colors.green,
                )
              : null,
          onTap: () async {
            final result = await Navigator.pushNamed(
              context,
              Routes.interestsOnSecurities,
            ) as bool?;
            if (result == true) {
              isInterestsOnSecurityFilled.value = true;
            }
          },
        ),
        const SizedBox(height: 12),
        ListTile(
          leading: Image.asset(
            'assets/icons/rent-n-property.png',
            width: 24,
          ),
          minLeadingWidth: 24,
          title: Text(AppLocalizations.of(context)!.rent_n_property),
          tileColor: Theme.of(context).colorScheme.secondary,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
            side: BorderSide(
              width: 0.5,
              color: Theme.of(context).colorScheme.primary.withOpacity(0.25),
            ),
          ),
          trailing: isRentNPropertyFilled.value == true
              ? const Icon(
                  Icons.done,
                  color: Colors.green,
                )
              : null,
          onTap: () async {
            final result = await Navigator.pushNamed(
              context,
              Routes.rentNProperty,
            ) as bool?;
            if (result == true) {
              isRentNPropertyFilled.value = true;
            }
          },
        ),
        const Spacer(),
        const SizedBox(height: 24),
        PrimaryButton(
          onTap: () {
            if (onComplete != null) onComplete!();
          },
          text: AppLocalizations.of(context)!.next,
        ),
        const SizedBox(height: 12),
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
              AppLocalizations.of(context)!.any_queries,
              style: Theme.of(context).textTheme.titleMedium,
            ),
            TextButton(
              onPressed: () {},
              child: Text(
                AppLocalizations.of(context)!.live_chat,
                style: Theme.of(context).textTheme.titleLarge?.copyWith(
                      color: Theme.of(context).colorScheme.primary,
                    ),
              ),
            )
          ],
        ),
      ],
    );
  }
}
