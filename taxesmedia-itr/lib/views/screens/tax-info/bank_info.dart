import 'package:dotted_border/dotted_border.dart';
import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/primary_button.dart';

class BankInfoTab extends HookWidget {
  const BankInfoTab({Key? key, this.onComplete}) : super(key: key);

  final Function()? onComplete;

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Expanded(
          child: ListView(
            children: [
              ListTile(
                leading: Image.asset(
                  'assets/icons/bank.png',
                  width: 24,
                ),
                minLeadingWidth: 24,
                title: const Text('Bank Asia'),
                tileColor: Theme.of(context).colorScheme.secondary,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                  side: BorderSide(
                    width: 0.5,
                    color:
                        Theme.of(context).colorScheme.primary.withOpacity(0.25),
                  ),
                ),
                trailing: IconButton(
                  icon: const Icon(Icons.more_horiz),
                  onPressed: () {},
                ),
                onTap: () {},
              ),
              const SizedBox(height: 12),
              ListTile(
                leading: Image.asset(
                  'assets/icons/bank.png',
                  width: 24,
                ),
                minLeadingWidth: 24,
                title: const Text('Dutch Bangla Bank Limited'),
                tileColor: Theme.of(context).colorScheme.secondary,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                  side: BorderSide(
                    width: 0.5,
                    color:
                        Theme.of(context).colorScheme.primary.withOpacity(0.25),
                  ),
                ),
                trailing: IconButton(
                  icon: const Icon(Icons.more_horiz),
                  onPressed: () {},
                ),
                onTap: () {},
              ),
              const SizedBox(height: 24),
              GestureDetector(
                onTap: () {
                  Navigator.pushNamed(context, Routes.addBankInfo);
                },
                child: DottedBorder(
                  strokeWidth: 0.5,
                  borderType: BorderType.RRect,
                  dashPattern: const [8, 4],
                  color: Colors.grey,
                  radius: const Radius.circular(20),
                  child: Center(
                    child: Padding(
                      padding: const EdgeInsets.symmetric(
                        horizontal: 20,
                        vertical: 20,
                      ),
                      child: Column(
                        children: [
                          CircleAvatar(
                            backgroundColor:
                                Theme.of(context).colorScheme.primary,
                            radius: 18,
                            child: const Icon(
                              Icons.add,
                              size: 30,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(height: 8),
                          Text(
                            AppLocalizations.of(context)!
                                .add_another_bank_account,
                            style: Theme.of(context).textTheme.titleLarge,
                          )
                        ],
                      ),
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
        const SizedBox(height: 24),
        PrimaryButton(
          onTap: () {
            if (onComplete != null) onComplete!();
          },
          text: AppLocalizations.of(context)!.submit,
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
