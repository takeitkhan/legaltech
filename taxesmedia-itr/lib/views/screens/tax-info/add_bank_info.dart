import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class AddBankInfo extends HookWidget {
  const AddBankInfo({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final formKey = GlobalKey<FormState>();
    final ValueNotifier<String?> accountType = useState('savings');
    final accountNumber = useTextEditingController();
    final bankName = useTextEditingController();
    final branch = useTextEditingController();

    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.bank_info,
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Form(
            key: formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  AppLocalizations.of(context)!.account_type,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                DropdownButtonFormField<String>(
                  value: accountType.value,
                  items: [
                    DropdownMenuItem(
                      value: 'savings',
                      child: Text(AppLocalizations.of(context)!.savings),
                    ),
                    DropdownMenuItem(
                      value: 'current',
                      child: Text(AppLocalizations.of(context)!.current),
                    ),
                  ],
                  onChanged: (value) {
                    accountType.value = value;
                  },
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.account_number,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: accountNumber,
                  keyboardType: TextInputType.number,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.bank_name,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: bankName,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.branch,
                  style: Theme.of(context).textTheme.titleMedium,
                ),
                const SizedBox(height: 12),
                TextField(
                  controller: branch,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const Spacer(),
                const SizedBox(height: 24),
                PrimaryButton(
                  onTap: () {
                    if (formKey.currentState?.validate() ?? false) {
                      Navigator.pop(context);
                    }
                  },
                  text: AppLocalizations.of(context)!.save,
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
